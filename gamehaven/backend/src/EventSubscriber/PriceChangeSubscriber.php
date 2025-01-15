<?php

namespace App\EventSubscriber;

use App\Event\PriceChangedEvent;
use App\Service\WishlistService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PriceChangeSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private WishlistService $wishlistService
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            PriceChangedEvent::class => 'onPriceChanged',
        ];
    }

    public function onPriceChanged(PriceChangedEvent $event): void
    {
        $gameListing = $event->getGameListing();
        $this->wishlistService->notifyPriceChange($gameListing, $event->getOldPrice(), $event->getNewPrice());
    }
}
