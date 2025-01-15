<?php

namespace App\Repository;

use App\Entity\GameListing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GameListing>
 */
class GameListingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameListing::class);
    }

    public function findPopularListings(int $limit = 10): array
    {
        return $this->createQueryBuilder('g')
            ->leftJoin('g.wishlists', 'w')
            ->groupBy('g.id')
            ->having('COUNT(w.id) > 0')
            ->orderBy('COUNT(w.id)', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findBySearchCriteria(array $criteria): array
    {
        $qb = $this->createQueryBuilder('g')
            ->leftJoin('g.seller', 's')
            ->addSelect('s')
            ->where('g.status = :status')
            ->setParameter('status', 'active');

        if (!empty($criteria['title'])) {
            $qb->andWhere('g.title LIKE :title')
               ->setParameter('title', '%' . $criteria['title'] . '%');
        }

        if (!empty($criteria['platform'])) {
            $qb->andWhere('g.platform = :platform')
               ->setParameter('platform', $criteria['platform']);
        }

        if (!empty($criteria['condition'])) {
            $qb->andWhere('g.condition = :condition')
               ->setParameter('condition', $criteria['condition']);
        }

        if (isset($criteria['maxPrice'])) {
            $qb->andWhere('g.price <= :maxPrice')
               ->setParameter('maxPrice', $criteria['maxPrice']);
        }

        if (isset($criteria['minPrice'])) {
            $qb->andWhere('g.price >= :minPrice')
               ->setParameter('minPrice', $criteria['minPrice']);
        }

        if (!empty($criteria['status'])) {
            $qb->andWhere('g.status = :status')
               ->setParameter('status', $criteria['status']);
        }

        return $qb->orderBy('g.createdAt', 'DESC')
                 ->getQuery()
                 ->getResult();
    }
}
