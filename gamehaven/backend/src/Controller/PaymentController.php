<?php

namespace App\Controller;

use App\Service\PaymentService;
use App\Service\TransactionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/payments')]
class PaymentController extends AbstractController
{
    public function __construct(
        private PaymentService $paymentService,
        private TransactionService $transactionService
    ) {}

    #[Route('/create-intent/{transactionId}', name: 'create_payment_intent', methods: ['POST'])]
    public function createPaymentIntent(int $transactionId): JsonResponse
    {
        $transaction = $this->transactionService->getTransaction($transactionId);
        if (!$transaction) {
            return $this->json(['error' => 'Transaction not found'], 404);
        }

        try {
            $intent = $this->paymentService->createPaymentIntent($transaction);
            return $this->json($intent);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }

    #[Route('/webhook', name: 'stripe_webhook', methods: ['POST'])]
    public function handleWebhook(Request $request): JsonResponse
    {
        try {
            $this->paymentService->handleWebhook(
                $request->getContent(),
                $request->headers->get('Stripe-Signature')
            );
            return $this->json(['status' => 'success']);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 400);
        }
    }
}
