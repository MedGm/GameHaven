<?php

namespace App\Repository;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Review>
 */
class ReviewRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Review::class);
    }

    public function getAverageRating(User $seller): float
    {
        $result = $this->createQueryBuilder('r')
            ->select('AVG(r.rating)')
            ->where('r.seller = :seller')
            ->setParameter('seller', $seller)
            ->getQuery()
            ->getSingleScalarResult();

        return $result ?? 0.0;
    }

    public function getReviewStatistics(User $seller): array
    {
        $qb = $this->createQueryBuilder('r');
        $ratings = $qb->select('r.rating, COUNT(r.id) as count')
            ->where('r.seller = :seller')
            ->setParameter('seller', $seller)
            ->groupBy('r.rating')
            ->getQuery()
            ->getResult();

        return array_combine(
            array_column($ratings, 'rating'),
            array_column($ratings, 'count')
        );
    }

    //    /**
    //     * @return Review[] Returns an array of Review objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Review
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
