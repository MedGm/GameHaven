<?php

namespace App\Service;

use App\Entity\Transaction;
use App\Entity\GameListing;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class TransactionService
{
    private const ALLOWED_STATUSES = ['pending', 'completed', 'cancelled', 'disputed'];

    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function createTransaction(GameListing $listing, User $buyer): Transaction
    {
        if ($listing->getStatus() !== 'active') {
            throw new \InvalidArgumentException('Listing is not available');
        }

        if ($buyer === $listing->getSeller()) {
            throw new \InvalidArgumentException('Cannot buy your own listing');
        }

        $transaction = new Transaction();
        $transaction->setBuyer($buyer);
        $transaction->setSeller($listing->getSeller());
        $transaction->setGameListing($listing);
        $transaction->setStatus('pending');

        $listing->setStatus('pending');

        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return $transaction;
    }

    public function updateTransactionStatus(Transaction $transaction, string $status): Transaction
    {
        $this->validateTransactionStatus($status);

        $transaction->setStatus($status);
        $transaction->setUpdatedAt(new \DateTimeImmutable());

        $listing = $transaction->getGameListing();
        if ($status === 'completed') {
            $listing->setStatus('sold');
        } elseif ($status === 'cancelled') {
            $listing->setStatus('active');
        }

        $this->entityManager->flush();

        return $transaction;
    }

    public function getUserTransactions(User $user): array
    {
        return $this->entityManager->getRepository(Transaction::class)
            ->findBy(['buyer' => $user]);
    }

    public function getSellerTransactions(User $seller): array
    {
        return $this->entityManager->getRepository(Transaction::class)
            ->findBy(['seller' => $seller]);
    }

    public function getTransaction(int $id): ?Transaction
    {
        return $this->entityManager->getRepository(Transaction::class)->find($id);
    }

    public function validateTransactionStatus(string $status): void
    {
        if (!in_array($status, self::ALLOWED_STATUSES)) {
            throw new \InvalidArgumentException('Invalid transaction status');
        }
    }

    /**
     * Get transaction statistics, either global or for a specific seller
     */
    public function getTransactionStats(?User $seller = null): array
    {
        $repository = $this->entityManager->getRepository(Transaction::class);
        
        if ($seller) {
            $transactions = $this->getSellerTransactions($seller);
            $completed = array_filter($transactions, fn($t) => $t->getStatus() === 'completed');
            
            return [
                'total' => count($transactions),
                'completed' => count($completed),
                'totalRevenue' => array_reduce(
                    $completed, 
                    fn($sum, $t) => $sum + $t->getGameListing()->getPrice(), 
                    0
                ),
                'pendingTransactions' => count(array_filter(
                    $transactions, 
                    fn($t) => $t->getStatus() === 'pending'
                ))
            ];
        }

        // Global stats
        return [
            'totalTransactions' => $repository->count([]),
            'completedTransactions' => $repository->count(['status' => 'completed']),
            'pendingTransactions' => $repository->count(['status' => 'pending']),
            'totalRevenue' => $repository->getTotalRevenue()
        ];
    }
}
