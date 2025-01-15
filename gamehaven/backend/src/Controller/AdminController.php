<?php

namespace App\Controller;

use App\Service\UserService;
use App\Service\TransactionService;
use App\Service\GameListingService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/admin')]
class AdminController extends AbstractController
{
    public function __construct(
        private UserService $userService,
        private TransactionService $transactionService,
        private GameListingService $gameListingService
    ) {}

    #[Route('/dashboard', name: 'admin_dashboard', methods: ['GET'])]
    public function getDashboardStats(): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->json([
            'users' => $this->userService->getUserStats(),
            'transactions' => $this->transactionService->getTransactionStats(),
            'listings' => $this->gameListingService->getListingStats()
        ]);
    }
}
