<?php

namespace App\Controller;

use App\Entity\GameListing;
use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/transactions')]
class TransactionController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    #[Route('', name: 'create_transaction', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!isset($data['game_listing_id'])) {
            return $this->json(['error' => 'game_listing_id is required'], 400);
        }

        $gameListing = $this->entityManager->getRepository(GameListing::class)->find($data['game_listing_id']);
        if (!$gameListing) {
            return $this->json(['error' => 'Game listing not found'], 404);
        }

        if ($gameListing->getStatus() !== 'Available') {
            return $this->json(['error' => 'Game listing is not available'], 400);
        }

        // Prevent buying own listing
        if ($gameListing->getSeller() === $this->getUser()) {
            return $this->json(['error' => 'Cannot purchase your own listing'], 400);
        }

        $transaction = new Transaction();
        $transaction->setBuyer($this->getUser());
        $transaction->setSeller($gameListing->getSeller());
        $transaction->setGameListing($gameListing);
        $transaction->setStatus('Pending');

        // Update game listing status
        $gameListing->setStatus('Reserved');
        
        $this->entityManager->persist($transaction);
        $this->entityManager->flush();

        return $this->json([
            'message' => 'Transaction created successfully',
            'transaction' => [
                'id' => $transaction->getId(),
                'status' => $transaction->getStatus(),
                'game_listing' => [
                    'id' => $gameListing->getId(),
                    'title' => $gameListing->getTitle(),
                    'price' => $gameListing->getPrice()
                ]
            ]
        ], 201);
    }

    #[Route('', name: 'get_transactions', methods: ['GET'])]
    public function getTransactions(): JsonResponse
    {
        $user = $this->getUser();
        $transactions = $this->entityManager->getRepository(Transaction::class)->findBy([
            'buyer' => $user
        ]);

        return $this->json([
            'transactions' => array_map(fn($transaction) => [
                'id' => $transaction->getId(),
                'status' => $transaction->getStatus(),
                'created_at' => $transaction->getCreatedAt()->format('Y-m-d H:i:s'),
                'game_listing' => [
                    'id' => $transaction->getGameListing()->getId(),
                    'title' => $transaction->getGameListing()->getTitle(),
                    'price' => $transaction->getGameListing()->getPrice()
                ],
                'seller' => [
                    'id' => $transaction->getSeller()->getId(),
                    'username' => $transaction->getSeller()->getUsername()
                ]
            ], $transactions)
        ]);
    }

    #[Route('/{id}', name: 'update_transaction', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $transaction = $this->entityManager->getRepository(Transaction::class)->find($id);
        
        if (!$transaction) {
            return $this->json(['error' => 'Transaction not found'], 404);
        }

        // Only seller can update transaction status
        if ($transaction->getSeller() !== $this->getUser()) {
            return $this->json(['error' => 'Not authorized'], 403);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['status'])) {
            return $this->json(['error' => 'Status is required'], 400);
        }

        $allowedStatuses = ['Pending', 'Completed', 'Cancelled'];
        if (!in_array($data['status'], $allowedStatuses)) {
            return $this->json(['error' => 'Invalid status'], 400);
        }

        $transaction->setStatus($data['status']);
        
        // Update game listing status accordingly
        if ($data['status'] === 'Completed') {
            $transaction->getGameListing()->setStatus('Sold');
        } elseif ($data['status'] === 'Cancelled') {
            $transaction->getGameListing()->setStatus('Available');
        }

        $this->entityManager->flush();

        return $this->json([
            'message' => 'Transaction updated successfully',
            'transaction' => [
                'id' => $transaction->getId(),
                'status' => $transaction->getStatus()
            ]
        ]);
    }
}
