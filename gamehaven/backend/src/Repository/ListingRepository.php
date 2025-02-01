<?php

namespace App\Repository;

use App\Entity\Listing;
use App\Entity\User;
use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Listing>
 */
class ListingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Listing::class);
    }

    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.user = :user')
            ->setParameter('user', $user)
            ->orderBy('l.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByGame(Game $game): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.gameId = :game')
            ->setParameter('game', $game)
            ->orderBy('l.price', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByPriceRange(float $min, float $max): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.price >= :min')
            ->andWhere('l.price <= :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('l.price', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Listing[] Returns an array of Listing objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Listing
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
