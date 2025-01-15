<?php

namespace App\Controller;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ReviewController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    #[Route('/reviews', name: 'create_review', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['seller_id']) || !isset($data['rating'])) {
            return $this->json(['error' => 'seller_id and rating are required'], 400);
        }

        $seller = $this->entityManager->getRepository(User::class)->find($data['seller_id']);
        if (!$seller) {
            return $this->json(['error' => 'Seller not found'], 404);
        }

        if ($seller === $this->getUser()) {
            return $this->json(['error' => 'Cannot review yourself'], 400);
        }

        $review = new Review();
        $review->setReviewer($this->getUser());
        $review->setSeller($seller);
        $review->setRating($data['rating']);
        $review->setComment($data['comment'] ?? null);
        
        $this->entityManager->persist($review);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Review created successfully',
            'review' => [
                'id' => $review->getId(),
                'rating' => $review->getRating(),
                'comment' => $review->getComment()
            ]
        ], 201);
    }

    #[Route('/users/{id}/reviews', name: 'get_user_reviews', methods: ['GET'])]
    public function getUserReviews(int $id): JsonResponse
    {
        $seller = $this->entityManager->getRepository(User::class)->find($id);
        if (!$seller) {
            return $this->json(['error' => 'User not found'], 404);
        }

        $reviews = $this->entityManager->getRepository(Review::class)->findBy([
            'seller' => $seller
        ]);

        return $this->json([
            'reviews' => array_map(fn($review) => [
                'id' => $review->getId(),
                'rating' => $review->getRating(),
                'comment' => $review->getComment(),
                'created_at' => $review->getCreatedAt()->format('Y-m-d H:i:s'),
                'reviewer' => [
                    'id' => $review->getReviewer()->getId(),
                    'username' => $review->getReviewer()->getUsername()
                ]
            ], $reviews)
        ]);
    }

    #[Route('/reviews/{id}', name: 'update_review', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $review = $this->entityManager->getRepository(Review::class)->find($id);
        if (!$review) {
            return $this->json(['error' => 'Review not found'], 404);
        }

        if ($review->getReviewer() !== $this->getUser()) {
            return $this->json(['error' => 'Not authorized'], 403);
        }

        $data = json_decode($request->getContent(), true);
        
        if (isset($data['rating'])) {
            $review->setRating($data['rating']);
        }
        if (isset($data['comment'])) {
            $review->setComment($data['comment']);
        }

        $this->entityManager->flush();

        return $this->json([
            'message' => 'Review updated successfully',
            'review' => [
                'id' => $review->getId(),
                'rating' => $review->getRating(),
                'comment' => $review->getComment()
            ]
        ]);
    }

    #[Route('/reviews/{id}', name: 'delete_review', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $review = $this->entityManager->getRepository(Review::class)->find($id);
        if (!$review) {
            return $this->json(['error' => 'Review not found'], 404);
        }

        if ($review->getReviewer() !== $this->getUser()) {
            return $this->json(['error' => 'Not authorized'], 403);
        }

        $this->entityManager->remove($review);
        $this->entityManager->flush();

        return $this->json(['message' => 'Review deleted successfully']);
    }
}
