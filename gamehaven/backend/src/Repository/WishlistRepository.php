<?php

namespace App\Repository;

use App\Entity\Wishlist;
use App\Entity\User;
use App\Entity\Game;
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

    public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.user = :user')
            ->setParameter('user', $user)
            ->orderBy('w.addedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findByGame(Game $game): array
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.game = :game')
            ->setParameter('game', $game)
            ->orderBy('w.addedAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function isGameInWishlist(User $user, Game $game): bool
    {
        $result = $this->createQueryBuilder('w')
            ->andWhere('w.user = :user')
            ->andWhere('w.game = :game')
            ->setParameter('user', $user)
            ->setParameter('game', $game)
            ->getQuery()
            ->getOneOrNullResult();
            
        return $result !== null;
    }
}
