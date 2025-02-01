<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Transaction;
use App\Entity\Listing;
use App\Entity\User;
use App\Repository\TransactionRepository;
use App\Repository\ListingRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/api/transactions', name: 'app_transaction_')]
class TransactionController extends AbstractController
{
    #[Route('', methods: ['GET'], name: 'index')]
    public function getAllTransactions(TransactionRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }

    #[Route('/{id}', methods: ['GET'], name: 'show')]
    public function getTransaction(int $id, TransactionRepository $repo): JsonResponse
    {
        $transaction = $repo->find($id);
        if (!$transaction) {
            return $this->json(['message' => 'Transaction not found'], 404);
        }
        return $this->json($transaction);
    }

    #[Route('', methods: ['POST'], name: 'create')]
    public function createTransaction(
        Request $request,
        EntityManagerInterface $em,
        ListingRepository $listingRepo,
        UserRepository $userRepo
    ): JsonResponse
    {
        try {
            $em->beginTransaction();
            
            $data = json_decode($request->getContent(), true);

            // Validate required fields
            if (!isset($data['listing_id'], $data['buyer_id'], $data['seller_id'], $data['price'])) {
                return $this->json(['message' => 'Missing required fields'], 400);
            }

            // Find and lock the listing for update
            $listing = $listingRepo->find($data['listing_id']);
            
            if (!$listing) {
                return $this->json(['message' => 'Listing not found'], 404);
            }

            // Check if listing is already sold
            if ($listing->isSold()) {
                return $this->json(['message' => 'This listing has already been sold'], 400);
            }

            $buyer = $userRepo->find($data['buyer_id']);
            $seller = $userRepo->find($data['seller_id']);

            if (!$buyer || !$seller) {
                return $this->json(['message' => 'Invalid buyer or seller ID'], 400);
            }

            // Validate seller owns the listing
            if ($listing->getUser() !== $seller) {
                return $this->json(['message' => 'Seller does not own this listing'], 403);
            }

            // Validate buyer is not the seller
            if ($buyer === $seller) {
                return $this->json(['message' => 'Cannot buy your own listing'], 400);
            }

            // Create transaction
            $transaction = new Transaction();
            $transaction->setListing($listing);
            $transaction->setBuyer($buyer);
            $transaction->setSeller($seller);
            $transaction->setPrice($data['price']);
            $transaction->setStatus('pending');
            
            if (isset($data['payment_method'])) {
                $transaction->setPaymentMethod($data['payment_method']);
            }

            // Mark listing as sold
            $listing->setSold(true);

            // Persist changes
            $em->persist($transaction);
            $em->flush();
            $em->commit();

            return $this->json([
                'message' => 'Transaction created successfully',
                'transaction' => [
                    'id' => $transaction->getId(),
                    'status' => $transaction->getStatus(),
                    'price' => $transaction->getPrice()
                ]
            ], 201);

        } catch (\Exception $e) {
            $em->rollback();
            return $this->json([
                'message' => 'Failed to create transaction',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    #[Route('/{id}', methods: ['PUT'], name: 'update')]
    public function updateTransaction(
        int $id,
        Request $request,
        EntityManagerInterface $em,
        TransactionRepository $repo
    ): JsonResponse
    {
        $transaction = $repo->find($id);
        if (!$transaction) {
            return $this->json(['message' => 'Transaction not found'], 404);
        }

        // Only allow buyer or seller to update transaction
        $currentUser = $this->getUser();
        if ($currentUser !== $transaction->getBuyer() && $currentUser !== $transaction->getSeller()) {
            return $this->json(['message' => 'Not authorized to update this transaction'], 403);
        }

        $data = json_decode($request->getContent(), true);
        
        if (isset($data['status'])) {
            // Validate status
            $allowedStatuses = ['pending', 'paid', 'completed', 'cancelled'];
            if (!in_array($data['status'], $allowedStatuses)) {
                return $this->json(['message' => 'Invalid status value'], 400);
            }
            $transaction->setStatus($data['status']);
        }

        if (isset($data['payment_method'])) {
            $transaction->setPaymentMethod($data['payment_method']);
        }

        try {
            $em->flush();
            return $this->json(['message' => 'Transaction updated successfully']);
        } catch (\Exception $e) {
            return $this->json(['message' => 'Failed to update transaction'], 500);
        }
    }

    #[Route('/{id}', methods: ['DELETE'], name: 'delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteTransaction(
        int $id,
        EntityManagerInterface $em,
        TransactionRepository $repo
    ): JsonResponse
    {
        $transaction = $repo->find($id);
        if (!$transaction) {
            return $this->json(['message' => 'Transaction not found'], 404);
        }

        try {
            $em->remove($transaction);
            $em->flush();
            return $this->json(['message' => 'Transaction deleted successfully']);
        } catch (\Exception $e) {
            return $this->json(['message' => 'Failed to delete transaction'], 500);
        }
    }

    #[Route('/user/purchases', methods: ['GET'], name: 'user_purchases')]
    public function getUserPurchases(TransactionRepository $repo): JsonResponse
    {
        $user = $this->getUser();
        return $this->json($repo->findByBuyer($user));
    }

    #[Route('/user/sales', methods: ['GET'], name: 'user_sales')]
    public function getUserSales(TransactionRepository $repo): JsonResponse
    {
        $user = $this->getUser();
        return $this->json($repo->findBySeller($user));
    }
}
