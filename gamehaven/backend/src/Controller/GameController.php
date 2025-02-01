<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\GameRepository;
use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/api/games', name: 'app_game_')]
final class GameController extends AbstractController
{
    private function addFullUrls(Request $request, $game): array
    {
        return [
            'id' => $game->getId(),
            'name' => $game->getName(),
            'platform' => $game->getPlatform(),
            'genre' => $game->getGenre(),
            'releaseDate' => $game->getReleaseDate(),
            'publisher' => $game->getPublisher(),
            'image_url' => $game->getImageUrl() ? $request->getSchemeAndHttpHost() . $game->getImageUrl() : null
        ];
    }

    private function getUploadDirectory(): string
    {
        try {
            $dir = $this->getParameter('game_images_directory');
        } catch (\Exception $e) {
            // Fallback to default directory if parameter is not set
            $dir = $this->getParameter('kernel.project_dir') . '/public/uploads/games';
        }
        
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        
        return $dir;
    }

    #[Route('', methods: ['GET'], name: 'index')]
    public function getAllGames(Request $request, GameRepository $gameRepository): JsonResponse
    {
        $games = $gameRepository->findAll();
        $gamesWithUrls = array_map(
            fn($game) => $this->addFullUrls($request, $game),
            $games
        );
        return $this->json($gamesWithUrls);
    }

    #[Route('/search', methods: ['GET'], name: 'search')]
    public function searchGames(Request $request, GameRepository $gameRepository): JsonResponse
    {
        try {
            $term = $request->query->get('q');
            if (!$term) {
                return $this->json(['message' => 'Search term is required'], 400);
            }

            $games = $gameRepository->searchGames($term);
            
            // Add full URLs to games
            $gamesWithUrls = array_map(
                fn($game) => $this->addFullUrls($request, $game),
                $games
            );

            return $this->json($gamesWithUrls);
        } catch (\Exception $e) {
            return $this->json(['message' => 'Search failed: ' . $e->getMessage()], 500);
        }
    }

    #[Route('/{id}', methods: ['GET'], name: 'show')]
    public function getGame(Request $request, int $id, GameRepository $gameRepository): JsonResponse
    {
        $game = $gameRepository->find($id);
        if (!$game) {
            return $this->json(['message' => 'Game not found'], Response::HTTP_NOT_FOUND);
        }

        $data = $this->addFullUrls($request, $game);

        return $this->json($data);
    }

    #[Route('/platform/{platform}', methods: ['GET'], name: 'by_platform')]
    public function getByPlatform(Request $request, string $platform, GameRepository $gameRepository): JsonResponse
    {
        $games = $gameRepository->findByPlatform($platform);
        $gamesWithUrls = array_map(
            fn($game) => $this->addFullUrls($request, $game),
            $games
        );
        return $this->json($gamesWithUrls);
    }

    #[Route('/genre/{genre}', methods: ['GET'], name: 'by_genre')]
    public function getByGenre(Request $request, string $genre, GameRepository $gameRepository): JsonResponse
    {
        $games = $gameRepository->findByGenre($genre);
        $gamesWithUrls = array_map(
            fn($game) => $this->addFullUrls($request, $game),
            $games
        );
        return $this->json($gamesWithUrls);
    }

    #[Route('', methods: ['POST'], name: 'create')]
    public function createGame(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        $game = new Game();
        $game->setName($data['name']);
        $game->setPlatform($data['platform']);
        $game->setGenre($data['genre'] ?? null);
        $game->setReleaseDate(new \DateTime($data['release_date']));
        $game->setPublisher($data['publisher'] ?? null);
        
        $em->persist($game);
        $em->flush();
        
        return $this->json([
            'message' => 'Game created successfully',
            'id' => $game->getId()
        ], 201);
    }

    #[Route('/{id}', methods: ['PUT'], name: 'update')]
    public function updateGame(
        int $id, 
        Request $request, 
        EntityManagerInterface $em,
        GameRepository $gameRepository
    ): JsonResponse
    {
        try {
            $game = $gameRepository->find($id);
            if (!$game) {
                return $this->json(['message' => 'Game not found'], 404);
            }

            // Handle file upload if present
            /** @var UploadedFile|null $file */
            $file = $request->files->get('image');
            if ($file) {
                // Validate file
                if (!$file->isValid()) {
                    return $this->json(['message' => 'Invalid file upload'], 400);
                }

                // Create uploads directory if it doesn't exist
                $uploadDir = $this->getUploadDirectory();
                if (!file_exists($uploadDir)) {
                    if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                        throw new \RuntimeException(sprintf('Directory "%s" was not created', $uploadDir));
                    }
                    chmod($uploadDir, 0777);
                }

                // Delete old image if exists
                $oldImagePath = $game->getImageUrl();
                if ($oldImagePath) {
                    $oldFilePath = $this->getParameter('kernel.project_dir') . '/public' . $oldImagePath;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                // Generate unique filename
                $newFilename = sprintf('game-%s-%s.%s', 
                    $game->getId(),
                    uniqid(),
                    $file->guessExtension() ?? 'png'
                );

                // Validate mime type
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $mimeType = $file->getMimeType();
                if (!in_array($mimeType, $allowedMimeTypes)) {
                    return $this->json(['message' => 'Only JPG, PNG and GIF images are allowed'], 400);
                }

                // Move file
                $file->move($uploadDir, $newFilename);
                chmod($uploadDir . '/' . $newFilename, 0777);

                // Update image URL
                $imageUrl = '/uploads/games/' . $newFilename;
                $game->setImageUrl($imageUrl);
            }

            // Handle JSON data if present
            $content = $request->getContent();
            if (!empty($content)) {
                $data = json_decode($content, true);
                
                if (isset($data['name'])) {
                    $game->setName($data['name']);
                }
                if (isset($data['platform'])) {
                    $game->setPlatform($data['platform']);
                }
                if (isset($data['genre'])) {
                    $game->setGenre($data['genre']);
                }
                if (isset($data['release_date'])) {
                    $game->setReleaseDate(new \DateTime($data['release_date']));
                }
                if (isset($data['publisher'])) {
                    $game->setPublisher($data['publisher']);
                }
            }

            $em->flush();
            
            return $this->json([
                'message' => 'Game updated successfully',
                'game' => $this->addFullUrls($request, $game)
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Failed to update game: ' . $e->getMessage()
            ], 500);
        }
    }

    #[Route('/{id}', methods: ['DELETE'], name: 'delete')]
    public function deleteGame(
        int $id,
        EntityManagerInterface $em,
        GameRepository $gameRepository
    ): JsonResponse
    {
        $game = $gameRepository->find($id);
        if (!$game) {
            return $this->json(['message' => 'Game not found'], 404);
        }

        $em->remove($game);
        $em->flush();
        
        return $this->json(['message' => 'Game deleted successfully']);
    }

    #[Route('/{id}/image', methods: ['POST'], name: 'update_image')]
    public function updateGameImage(
        int $id,
        Request $request,
        GameRepository $gameRepository,
        EntityManagerInterface $em
    ): JsonResponse {
        try {
            $game = $gameRepository->find($id);
            if (!$game) {
                return $this->json(['message' => 'Game not found'], 404);
            }

            /** @var UploadedFile|null $file */
            $file = $request->files->get('image');
            
            if (!$file) {
                return $this->json(['message' => 'No file uploaded'], 400);
            }

            // Debug log
            error_log('File upload received: ' . $file->getClientOriginalName());
            error_log('File mime type: ' . $file->getMimeType());
            error_log('File size: ' . $file->getSize());

            // Validate file
            if (!$file->isValid()) {
                error_log('File validation failed');
                return $this->json(['message' => 'Invalid file upload'], 400);
            }

            // Use the new method to get upload directory
            $uploadDir = $this->getUploadDirectory();

            // Delete old image
            $oldImagePath = $game->getImageUrl();
            if ($oldImagePath) {
                $oldFilePath = $this->getParameter('kernel.project_dir') . '/public' . $oldImagePath;
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            // Generate filename and move file
            $filename = sprintf('game-%s-%s.%s', 
                $game->getId(),
                uniqid(),
                $file->guessExtension() ?? 'png'
            );

            // Debug log
            error_log('Generated filename: ' . $filename);
            error_log('Upload directory: ' . $uploadDir);

            try {
                $file->move($uploadDir, $filename);
                chmod($uploadDir . '/' . $filename, 0777);
            } catch (\Exception $e) {
                error_log('File move failed: ' . $e->getMessage());
                throw $e;
            }

            // Update database
            $imageUrl = '/uploads/games/' . $filename;
            $game->setImageUrl($imageUrl);
            $em->flush();

            error_log('Database updated with image URL: ' . $imageUrl);

            return $this->json([
                'message' => 'Game image updated successfully',
                'image_url' => $imageUrl,
                'full_url' => $request->getSchemeAndHttpHost() . $imageUrl
            ]);

        } catch (\Exception $e) {
            error_log('Image upload failed: ' . $e->getMessage());
            return $this->json([
                'message' => 'Failed to upload image: ' . $e->getMessage()
            ], 500);
        }
    }
}
