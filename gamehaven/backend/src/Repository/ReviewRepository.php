<?php

namespace App\Repository;

use App\Entity\Review;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\User;
use App\Entity\Transaction;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function findByReviewer(User $reviewer): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.reviewer = :reviewer')
            ->setParameter('reviewer', $reviewer)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByReviewed(User $reviewed): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.reviewed = :reviewed')
            ->setParameter('reviewed', $reviewed)
            ->orderBy('r.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByTransaction(Transaction $transaction): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.transaction = :transaction')
            ->setParameter('transaction', $transaction)
            ->getQuery()
            ->getResult();
    }

    public function getAverageRating(User $user): ?float
    {
        return $this->createQueryBuilder('r')
            ->select('AVG(r.rating)')
            ->andWhere('r.reviewed = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
