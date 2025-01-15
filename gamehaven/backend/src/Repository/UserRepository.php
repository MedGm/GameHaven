<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findActiveSellers(): array
    {
        return $this->createQueryBuilder('u')
            ->join('u.listings', 'l')
            ->where('l.status = :status')
            ->setParameter('status', 'active')
            ->groupBy('u.id')
            ->having('COUNT(l.id) > 0')
            ->getQuery()
            ->getResult();
    }

    public function findTopSellers(int $limit = 10): array
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.listings', 'l')
            ->leftJoin('l.transactions', 't')
            ->where('t.status = :status')
            ->setParameter('status', 'completed')
            ->groupBy('u.id')
            ->orderBy('COUNT(t.id)', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findBySearchTerm(string $term): array
    {
        return $this->createQueryBuilder('u')
            ->where('u.username LIKE :term')
            ->orWhere('u.email LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->getQuery()
            ->getResult();
    }

    public function getUserStatistics(User $user): array
    {
        $qb = $this->createQueryBuilder('u')
            ->select('u.id, 
                     COUNT(DISTINCT l.id) as totalListings,
                     COUNT(DISTINCT t.id) as totalSales,
                     AVG(r.rating) as averageRating')
            ->leftJoin('u.listings', 'l')
            ->leftJoin('l.transactions', 't')
            ->leftJoin('u.receivedReviews', 'r')
            ->where('u.id = :userId')
            ->setParameter('userId', $user->getId())
            ->groupBy('u.id');

        $result = $qb->getQuery()->getOneOrNullResult();

        return [
            'totalListings' => $result['totalListings'] ?? 0,
            'totalSales' => $result['totalSales'] ?? 0,
            'averageRating' => round($result['averageRating'] ?? 0, 1),
        ];
    }

    //    /**
    //     * @return User[] Returns an array of User objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?User
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
