<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/api/payments', name: 'app_payment_')]
class PaymentController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
    }

    #[Route('/create-intent', name: 'create_intent', methods: ['POST'])]
    public function createPaymentIntent(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);
            
            // Validate amount
            if (!isset($data['amount']) || $data['amount'] < 50) { // Minimum 50 cents
                throw new \Exception('Invalid amount');
            }

            $paymentIntent = PaymentIntent::create([
                'amount' => (int) $data['amount'],
                'currency' => $data['currency'] ?? 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
                'metadata' => [
                    'transaction_id' => $data['transaction_id'] ?? null,
                ],
            ]);

            return $this->json([
                'clientSecret' => $paymentIntent->client_secret
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'error' => [
                    'message' => $e->getMessage()
                ]
            ], 500);
        }
    }
}
