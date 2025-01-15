<?php
// src/Controller/GameListingController.php
namespace App\Controller;

use App\Service\GameListingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/listings')]
class GameListingController extends AbstractController
{
    public function __construct(
        private GameListingService $gameListingService,
        private EntityManagerInterface $entityManager  // Add this dependency
    ) {}

    #[Route('', name: 'create_listing', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        try {
            $listing = $this->gameListingService->createListing(
                $data,
                $this->getUser()
            );
            
            return $this->json([
                'message' => 'Listing created successfully',
                'listing' => [
                    'id' => $listing->getId(),
                    'title' => $listing->getTitle(),
                    'price' => $listing->getPrice()
                ]
            ], 201);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('', name: 'get_listings', methods: ['GET'])]
    public function getListings(Request $request): JsonResponse
    {
        $listings = $this->gameListingService->getListings();
        
        return $this->json([
            'listings' => array_map(fn($listing) => [
                'id' => $listing->getId(),
                'title' => $listing->getTitle(),
                'price' => $listing->getPrice(),
                'platform' => $listing->getPlatform(),
                'condition' => $listing->getCondition(),
                'seller' => [
                    'id' => $listing->getSeller()->getId(),
                    'username' => $listing->getSeller()->getUsername()
                ]
            ], $listings)
        ]);
    }

    #[Route('/{id}', name: 'get_listing', methods: ['GET'])]
    public function getListing(int $id): JsonResponse
    {
        $listing = $this->gameListingService->getListing($id);
        
        if (!$listing) {
            return $this->json(['error' => 'Listing not found'], 404);
        }

        return $this->json([
            'listing' => [
                'id' => $listing->getId(),
                'title' => $listing->getTitle(),
                'price' => $listing->getPrice(),
                'platform' => $listing->getPlatform(),
                'condition' => $listing->getCondition(),
                'description' => $listing->getDescription(),
                'seller' => [
                    'id' => $listing->getSeller()->getId(),
                    'username' => $listing->getSeller()->getUsername()
                ]
            ]
        ]);
    }

    #[Route('/{id}', name: 'update_listing', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $listing = $this->gameListingService->getListing($id);
        
        if (!$listing) {
            return $this->json(['error' => 'Listing not found'], 404);
        }

        if ($listing->getSeller() !== $this->getUser()) {
            return $this->json(['error' => 'Not authorized'], 403);
        }

        try {
            $data = json_decode($request->getContent(), true);
            $updatedListing = $this->gameListingService->updateListing($listing, $data);
            
            return $this->json([
                'message' => 'Listing updated successfully',
                'listing' => [
                    'id' => $updatedListing->getId(),
                    'title' => $updatedListing->getTitle(),
                    'price' => $updatedListing->getPrice()
                ]
            ]);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/{id}', name: 'delete_listing', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $listing = $this->gameListingService->getListing($id);
        
        if (!$listing) {
            return $this->json(['error' => 'Listing not found'], 404);
        }

        if ($listing->getSeller() !== $this->getUser()) {
            return $this->json(['error' => 'Not authorized'], 403);
        }

        try {
            $this->gameListingService->deleteListing($listing);
            return $this->json(['message' => 'Listing deleted successfully']);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/search', name: 'search_listings', methods: ['GET'])]
    public function searchListings(Request $request): JsonResponse
    {
        $criteria = [
            'title' => $request->query->get('title'),
            'platform' => $request->query->get('platform'),
            'condition' => $request->query->get('condition'),
            'maxPrice' => $request->query->get('maxPrice'),
            'minPrice' => $request->query->get('minPrice'),
            'status' => $request->query->get('status', 'active')
        ];

        $listings = $this->gameListingService->getListings($criteria); // Use service instead of direct repository access

        return $this->json([
            'listings' => array_map(fn($listing) => [
                'id' => $listing->getId(),
                'title' => $listing->getTitle(),
                'price' => $listing->getPrice(),
                'platform' => $listing->getPlatform(),
                'condition' => $listing->getCondition(),
                'seller' => [
                    'id' => $listing->getSeller()->getId(),
                    'username' => $listing->getSeller()->getUsername()
                ]
            ], $listings)
        ]);
    }

    // Add image upload endpoint
    #[Route('/{id}/images', name: 'add_listing_image', methods: ['POST'])]
    public function addImage(int $id, Request $request): JsonResponse
    {
        $listing = $this->gameListingService->getListing($id);
        if (!$listing) {
            return $this->json(['error' => 'Listing not found'], 404);
        }

        if ($listing->getSeller() !== $this->getUser()) {
            return $this->json(['error' => 'Not authorized'], 403);
        }

        try {
            $imageUrl = $request->request->get('imageUrl');
            $image = $this->gameListingService->addImage($listing, $imageUrl);
            
            return $this->json([
                'message' => 'Image added successfully',
                'image' => ['id' => $image->getId(), 'url' => $image->getImageUrl()]
            ], 201);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }
}