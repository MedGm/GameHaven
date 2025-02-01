<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ListingRepository;
use App\Entity\Listing;
use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/listings', name: 'app_listing_')]
class ListingController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function getListings(ListingRepository $repo): JsonResponse
    {
        // Only return listings that aren't sold
        return $this->json($repo->findBy(['sold' => false]));
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getListing(int $id, ListingRepository $repo): JsonResponse
    {
        $listing = $repo->find($id);
        return $this->json($listing);
    }

    #[Route('', methods: ['POST'])]
    public function createListing(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $listing = new Listing();
        
        $listing->setPrice($data['price']);
        $listing->setCondition($data['condition']);
        $listing->setDescription($data['description']);
        $game = $em->getReference(Game::class, $data['game_id']);
        $listing->setGameId($game);
        $user = $this->getUser();
        $listing->setUser($user);

        $em->persist($listing);
        $em->flush();
        
        return $this->json([
            'message' => 'Listing created successfully',
            'id' => $listing->getId()
        ]);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function updateListing(
        int $id,
        Request $request, 
        EntityManagerInterface $em,
        ListingRepository $repo
    ): JsonResponse
    {
        $listing = $repo->find($id);
        if (!$listing) {
            return $this->json(['message' => 'Listing not found'], 404);
        }

        $data = json_decode($request->getContent(), true);
        
        if (isset($data['price'])) {
            $listing->setPrice($data['price']);
        }
        if (isset($data['condition'])) {
            $listing->setCondition($data['condition']);
        }
        if (isset($data['description'])) {
            $listing->setDescription($data['description']);
        }
        if (isset($data['game_id'])) {
            $game = $em->getReference(Game::class, $data['game_id']);
            $listing->setGameId($game);
        }
        
        $em->flush();
        
        return $this->json(['message' => 'Listing updated successfully']);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function deleteListing(
        int $id,
        EntityManagerInterface $em,
        ListingRepository $repo
    ): JsonResponse
    {
        $listing = $repo->find($id);
        if (!$listing) {
            return $this->json(['message' => 'Listing not found'], 404);
        }

        // Check if user is the owner
        if ($listing->getUser() !== $this->getUser()) {
            return $this->json(['message' => 'Not authorized'], 403);
        }
        
        $em->remove($listing);
        $em->flush();
        
        return $this->json(['message' => 'Listing deleted successfully']);
    }
}
