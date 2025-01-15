<?php

namespace App\Service;

use App\Entity\Transaction;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;

class PaymentService
{
    public function __construct(
        private string $stripeSecretKey,
        private string $stripeWebhookSecret,
        private TransactionService $transactionService
    ) {
        Stripe::setApiKey($stripeSecretKey);
    }

    public function createPaymentIntent(Transaction $transaction): array
    {
        $paymentIntent = PaymentIntent::create([
            'amount' => $transaction->getGameListing()->getPrice() * 100, // Convert to cents
            'currency' => 'eur',
            'metadata' => [
                'transaction_id' => $transaction->getId(),
                'buyer_id' => $transaction->getBuyer()->getId()
            ]
        ]);

        return [
            'clientSecret' => $paymentIntent->client_secret,
            'paymentId' => $paymentIntent->id
        ];
    }

    public function handleWebhook(string $payload, string $sigHeader): void
    {
        try {
            $event = Webhook::constructEvent(
                $payload,
                $sigHeader,
                $this->stripeWebhookSecret
            );

            switch ($event->type) {
                case 'payment_intent.succeeded':
                    $this->handleSuccessfulPayment($event->data->object);
                    break;
                case 'payment_intent.payment_failed':
                    $this->handleFailedPayment($event->data->object);
                    break;
            }
        } catch (SignatureVerificationException $e) {
            throw new \Exception('Invalid signature');
        } catch (\Exception $e) {
            throw new \Exception('Webhook error: ' . $e->getMessage());
        }
    }

    private function handleSuccessfulPayment($paymentIntent): void
    {
        $transactionId = $paymentIntent->metadata['transaction_id'] ?? null;
        if (!$transactionId) {
            throw new \Exception('Transaction ID not found in metadata');
        }

        $transaction = $this->transactionService->getTransaction($transactionId);
        if (!$transaction) {
            throw new \Exception('Transaction not found');
        }

        $this->transactionService->updateTransactionStatus($transaction, 'completed');
    }

    private function handleFailedPayment($paymentIntent): void
    {
        $transactionId = $paymentIntent->metadata['transaction_id'] ?? null;
        if ($transactionId) {
            $transaction = $this->transactionService->getTransaction($transactionId);
            if ($transaction) {
                $this->transactionService->updateTransactionStatus($transaction, 'cancelled');
            }
        }
    }

    private function validatePayment(array $paymentIntent): void
    {
        if (!isset($paymentIntent['metadata']['transaction_id'])) {
            throw new \InvalidArgumentException('Invalid payment: missing transaction ID');
        }
    }
}
