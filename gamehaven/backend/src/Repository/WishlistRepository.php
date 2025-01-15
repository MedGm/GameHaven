<?php

namespace App\Repository;

use App\Entity\Wishlist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Wishlist>
 */
class WishlistRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Wishlist::class);
    }

    public function findPriceDrops(): array
    {
        return $this->createQueryBuilder('w')
            ->join('w.gameListing', 'g')
            ->where('g.status = :status')
            ->setParameter('status', 'active')
            ->orderBy('g.price', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findWishlistWithDetails(int $userId): array
    {
        return $this->createQueryBuilder('w')
            ->addSelect('g', 's')
            ->join('w.gameListing', 'g')
            ->join('g.seller', 's')
            ->where('w.user = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('w.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Wishlist[] Returns an array of Wishlist objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('w.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Wishlist
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
