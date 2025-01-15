<?php

namespace App\Service;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ReviewService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function createReview(array $data, User $reviewer, User $seller): Review
    {
        if (!isset($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
            throw new \InvalidArgumentException('Invalid rating value');
        }

        $review = new Review();
        $review->setReviewer($reviewer);
        $review->setSeller($seller);
        $review->setRating($data['rating']);
        $review->setComment($data['comment'] ?? null);

        $this->entityManager->persist($review);
        $this->entityManager->flush();

        return $review;
    }

    public function getSellerReviews(User $seller): array
    {
        return $this->entityManager->getRepository(Review::class)
            ->findBy(['seller' => $seller]);
    }

    public function getSellerRating(User $seller): array
    {
        $reviews = $this->getSellerReviews($seller);
        $totalRating = array_reduce($reviews, fn($sum, $review) => $sum + $review->getRating(), 0);
        $count = count($reviews);

        return [
            'average' => $count > 0 ? round($totalRating / $count, 1) : 0,
            'count' => $count
        ];
    }

    public function validateReviewData(array $data): void
    {
        if (!isset($data['rating']) || !is_numeric($data['rating']) || 
            $data['rating'] < 1 || $data['rating'] > 5) {
            throw new \InvalidArgumentException('Rating must be between 1 and 5');
        }

        if (isset($data['comment']) && strlen($data['comment']) > 1000) {
            throw new \InvalidArgumentException('Comment is too long (max 1000 characters)');
        }
    }

    public function hasUserReviewedSeller(User $reviewer, User $seller): bool
    {
        $existingReview = $this->entityManager->getRepository(Review::class)
            ->findOneBy(['reviewer' => $reviewer, 'seller' => $seller]);
            
        return $existingReview !== null;
    }

    private function validateReview(array $data): void
    {
        if (!isset($data['rating']) || !is_numeric($data['rating']) || 
            $data['rating'] < 1 || $data['rating'] > 5) {
            throw new \InvalidArgumentException('Rating must be between 1 and 5');
        }

        if (isset($data['comment']) && strlen($data['comment']) > 1000) {
            throw new \InvalidArgumentException('Comment is too long (max 1000 characters)');
        }
    }

    public function getSellerStatistics(User $seller): array
    {
        $reviews = $this->getSellerReviews($seller);
        $ratings = array_column($reviews, 'rating');

        return [
            'averageRating' => count($ratings) > 0 ? array_sum($ratings) / count($ratings) : 0,
            'totalReviews' => count($reviews),
            'ratingDistribution' => array_count_values($ratings),
            'recentReviews' => array_slice($reviews, 0, 5)
        ];
    }
}
