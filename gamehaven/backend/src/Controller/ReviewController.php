<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use App\Repository\UserRepository;
use App\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/reviews')]
final class ReviewController extends AbstractController
{
    public function __construct(
        private ReviewRepository $reviewRepository,
        private UserRepository $userRepository,
        private TransactionRepository $transactionRepository,
        private EntityManagerInterface $entityManager
    ) {}

    #[Route('', name: 'get_all_reviews', methods: ['GET'])]
    public function getAllReviews(): JsonResponse
    {
        $reviews = $this->reviewRepository->findAll();
        
        $formattedReviews = array_map(function($review) {
            return [
                'id' => $review->getId(),
                'transaction_id' => $review->getTransaction()->getId(),
                'reviewer' => [
                    'id' => $review->getReviewer()->getId(),
                    'username' => $review->getReviewer()->getUsername()
                ],
                'reviewed' => [
                    'id' => $review->getReviewed()->getId(),
                    'username' => $review->getReviewed()->getUsername()
                ],
                'rating' => $review->getRating(),
                'comment' => $review->getComment(),
                'created_at' => $review->getCreatedAt()->format('Y-m-d H:i:s')
            ];
        }, $reviews);

        return $this->json($formattedReviews);
    }

    #[Route('/{id}', name: 'get_one_review', methods: ['GET'])]
    public function getOneReview(int $id): JsonResponse
    {
        $review = $this->reviewRepository->find($id);
        
        if (!$review) {
            return $this->json(['error' => 'Review not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json([
            'id' => $review->getId(),
            'transaction_id' => $review->getTransaction()->getId(),
            'reviewer' => [
                'id' => $review->getReviewer()->getId(),
                'username' => $review->getReviewer()->getUsername()
            ],
            'reviewed' => [
                'id' => $review->getReviewed()->getId(),
                'username' => $review->getReviewed()->getUsername()
            ],
            'rating' => $review->getRating(),
            'comment' => $review->getComment(),
            'created_at' => $review->getCreatedAt()->format('Y-m-d H:i:s')
        ]);
    }

    #[Route('', name: 'create_review', methods: ['POST'])]
    public function createReview(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Validate required fields
        if (!isset($data['transaction_id']) || !isset($data['reviewer_id']) || 
            !isset($data['rating']) || !isset($data['comment'])) {
            return $this->json(['error' => 'Missing required fields'], Response::HTTP_BAD_REQUEST);
        }

        // Validate rating range
        if ($data['rating'] < 1 || $data['rating'] > 5) {
            return $this->json(['error' => 'Rating must be between 1 and 5'], Response::HTTP_BAD_REQUEST);
        }

        $transaction = $this->transactionRepository->find($data['transaction_id']);
        $reviewer = $this->userRepository->find($data['reviewer_id']);

        if (!$transaction || !$reviewer) {
            return $this->json(['error' => 'Transaction or User not found'], Response::HTTP_NOT_FOUND);
        }

        // Create new review
        $review = new Review();
        $review->setTransaction($transaction);
        $review->setReviewer($reviewer);
        $review->setReviewed($transaction->getSeller() === $reviewer ? $transaction->getBuyer() : $transaction->getSeller());
        $review->setRating($data['rating']);
        $review->setComment($data['comment']);

        $this->entityManager->persist($review);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Review created successfully',
            'review_id' => $review->getId()
        ], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'delete_review', methods: ['DELETE'])]
    public function deleteReview(int $id): JsonResponse
    {
        $review = $this->reviewRepository->find($id);
        
        if (!$review) {
            return $this->json(['error' => 'Review not found'], Response::HTTP_NOT_FOUND);
        }

        $this->entityManager->remove($review);
        $this->entityManager->flush();

        return $this->json(['message' => 'Review deleted successfully']);
    }
}
