<?php

namespace App\Controller;

use App\Entity\GameListing;
use App\Entity\Wishlist;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/wishlist')]
class WishlistController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    #[Route('', name: 'add_to_wishlist', methods: ['POST'])]
    public function addToWishlist(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['game_listing_id'])) {
            return $this->json(['error' => 'game_listing_id is required'], 400);
        }

        $gameListing = $this->entityManager->getRepository(GameListing::class)->find($data['game_listing_id']);
        if (!$gameListing) {
            return $this->json(['error' => 'Game listing not found'], 404);
        }

        // Check if already in wishlist
        $existingWishlist = $this->entityManager->getRepository(Wishlist::class)->findOneBy([
            'user' => $this->getUser(),
            'gameListing' => $gameListing
        ]);

        if ($existingWishlist) {
            return $this->json(['error' => 'Already in wishlist'], 400);
        }

        $wishlist = new Wishlist();
        $wishlist->setUser($this->getUser());
        $wishlist->setGameListing($gameListing);
        
        $this->entityManager->persist($wishlist);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Added to wishlist successfully',
            'wishlist' => [
                'id' => $wishlist->getId(),
                'game_listing' => [
                    'id' => $gameListing->getId(),
                    'title' => $gameListing->getTitle()
                ]
            ]
        ], 201);
    }

    #[Route('', name: 'get_wishlist', methods: ['GET'])]
    public function getWishlist(): JsonResponse
    {
        $wishlists = $this->entityManager->getRepository(Wishlist::class)->findBy([
            'user' => $this->getUser()
        ]);

        return $this->json([
            'wishlists' => array_map(fn($wishlist) => [
                'id' => $wishlist->getId(),
                'game_listing' => [
                    'id' => $wishlist->getGameListing()->getId(),
                    'title' => $wishlist->getGameListing()->getTitle(),
                    'price' => $wishlist->getGameListing()->getPrice(),
                    'platform' => $wishlist->getGameListing()->getPlatform()
                ]
            ], $wishlists)
        ]);
    }

    #[Route('/{id}', name: 'remove_from_wishlist', methods: ['DELETE'])]
    public function removeFromWishlist(int $id): JsonResponse
    {
        $wishlist = $this->entityManager->getRepository(Wishlist::class)->find($id);
        
        if (!$wishlist) {
            return $this->json(['error' => 'Wishlist item not found'], 404);
        }

        if ($wishlist->getUser() !== $this->getUser()) {
            return $this->json(['error' => 'Not authorized'], 403);
        }

        $this->entityManager->remove($wishlist);
        $this->entityManager->flush();

        return $this->json(['message' => 'Removed from wishlist successfully']);
    }
}
