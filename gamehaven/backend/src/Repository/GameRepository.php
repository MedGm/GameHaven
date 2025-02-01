<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function findByPlatform(string $platform): array
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.platform = :platform')
            ->setParameter('platform', $platform)
            ->orderBy('g.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByGenre(string $genre): array
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.genre = :genre')
            ->setParameter('genre', $genre)
            ->orderBy('g.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByPublisher(string $publisher): array
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.publisher = :publisher')
            ->setParameter('publisher', $publisher)
            ->orderBy('g.releaseDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function searchGames(string $term): array
    {
        return $this->createQueryBuilder('g')
            ->where('LOWER(g.name) LIKE LOWER(:term)')
            ->orWhere('LOWER(g.publisher) LIKE LOWER(:term)')
            ->orWhere('LOWER(g.genre) LIKE LOWER(:term)')
            ->setParameter('term', '%' . $term . '%')
            ->orderBy('g.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Game[] Returns an array of Game objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Game
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
