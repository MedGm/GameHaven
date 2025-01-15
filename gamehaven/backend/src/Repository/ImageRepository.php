<?php

namespace App\Repository;

use App\Entity\Image;
use App\Entity\GameListing;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Image>
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    public function findByGameListing(GameListing $gameListing): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.gameListing = :gameListing')
            ->setParameter('gameListing', $gameListing)
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function deleteGameListingImages(GameListing $gameListing): void
    {
        $this->createQueryBuilder('i')
            ->delete()
            ->where('i.gameListing = :gameListing')
            ->setParameter('gameListing', $gameListing)
            ->getQuery()
            ->execute();
    }

    public function getMainImage(GameListing $gameListing): ?Image
    {
        return $this->createQueryBuilder('i')
            ->where('i.gameListing = :gameListing')
            ->setParameter('gameListing', $gameListing)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    /**
    //     * @return Image[] Returns an array of Image objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Image
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
