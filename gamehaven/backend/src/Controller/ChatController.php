<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Repository\ChatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Attribute\Route;
use Psr\Log\LoggerInterface;

#[Route('/api/chat', name: 'app_chat_')]
class ChatController extends AbstractController
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    private function getFullAssetUrl(Request $request, string $path): string 
    {
        return '//' . $request->getHttpHost() . $path;
    }

    #[Route('/messages', name: 'messages', methods: ['GET'])]
    public function getMessages(Request $request, ChatRepository $chatRepository): JsonResponse
    {
        $messages = $chatRepository->findLatestMessages();
        
        $formattedMessages = array_map(function($chat) use ($request) {
            $user = $chat->getUser();
            return [
                'id' => $chat->getId(),
                'message' => $chat->getMessage(),
                'fileUrl' => $chat->getFileUrl() ? $this->getFullAssetUrl($request, $chat->getFileUrl()) : null,
                'fileType' => $chat->getFileType(),
                'createdAt' => $chat->getCreatedAt()->format('Y-m-d H:i:s'),
                'user' => [
                    'id' => $user->getId(),
                    'username' => $user->getUserIdentifier(),
                    'avatarUrl' => $user->getAvatarUrl() ?? null
                ]
            ];
        }, $messages);

        return $this->json($formattedMessages);
    }

    #[Route('/messages', name: 'send_message', methods: ['POST'])]
    public function sendMessage(Request $request, EntityManagerInterface $em): JsonResponse
    {
        try {
            $user = $this->getUser();
            if (!$user) {
                return $this->json(['message' => 'Unauthorized'], 401);
            }

            $file = $request->files->get('file');
            $message = $request->request->get('message');

            // Ensure at least one of message or file is provided
            if (empty($message) && !$file) {
                return $this->json(['message' => 'Message or file is required'], 400);
            }

            $chat = new Chat();
            $chat->setMessage($message ?? '');
            $chat->setUser($user);

            if ($file) {
                // Validate file type
                $mimeType = $file->getMimeType();
                $originalExtension = strtolower($file->getClientOriginalExtension());
                
                $allowedTypes = [
                    'application/pdf' => 'pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx'
                ];

                if (!array_key_exists($mimeType, $allowedTypes) || 
                    !in_array($originalExtension, ['pdf', 'docx'])) {
                    return $this->json([
                        'message' => 'Only PDF and DOCX files are allowed'
                    ], 400);
                }

                $uploadDir = $this->getParameter('chat_files_directory');
                
                // Create directory if it doesn't exist
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Sanitize the original filename while keeping its name
                $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $this->slugify($originalName);
                
                // Add unique identifier as prefix to prevent overwriting
                $newFilename = sprintf('%s-%s.%s', 
                    uniqid(),
                    $safeFilename,
                    $originalExtension
                );

                try {
                    $file->move($uploadDir, $newFilename);
                    $fileUrl = '/uploads/chat/' . $newFilename;
                    $chat->setFileUrl($fileUrl);
                    $chat->setFileType($mimeType);
                } catch (\Exception $e) {
                    $this->logger->error('File upload failed', [
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString(),
                        'original_name' => $file->getClientOriginalName(),
                        'safe_name' => $newFilename
                    ]);
                    return $this->json(['message' => 'Failed to upload file'], 500);
                }
            }

            $em->persist($chat);
            $em->flush();

            return $this->json([
                'id' => $chat->getId(),
                'message' => $chat->getMessage(),
                'fileUrl' => $chat->getFileUrl() ? $this->getFullAssetUrl($request, $chat->getFileUrl()) : null,
                'fileType' => $chat->getFileType(),
                'createdAt' => $chat->getCreatedAt()->format('Y-m-d H:i:s'),
                'user' => [
                    'id' => $user->getId(),
                    'username' => $user->getUserIdentifier(),
                    'avatarUrl' => $user->getAvatarUrl() ?? null
                ]
            ], 201);

        } catch (\Exception $e) {
            $this->logger->error('Chat message failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return $this->json(['message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    private function slugify(string $text): string
    {
        // Replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // Transliterate
        $text = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9\-] remove; Lower()', $text);
        // Remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // Trim
        $text = trim($text, '-');
        // Remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // Lowercase
        $text = strtolower($text);
        
        return empty($text) ? 'n-a' : $text;
    }
}
