<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transaction>
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function getTotalRevenue(): float
    {
        $result = $this->createQueryBuilder('t')
            ->select('SUM(g.price)')
            ->join('t.gameListing', 'g')
            ->where('t.status = :status')
            ->setParameter('status', 'completed')
            ->getQuery()
            ->getSingleScalarResult();

        return $result ?? 0.0;
    }

    public function findUserTransactionsWithDetails(int $userId): array
    {
        return $this->createQueryBuilder('t')
            ->addSelect('g', 'b', 's')
            ->join('t.gameListing', 'g')
            ->join('t.buyer', 'b')
            ->join('t.seller', 's')
            ->where('t.buyer = :userId OR t.seller = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('t.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
