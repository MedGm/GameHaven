<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\GameListing;
use Symfony\Contracts\EventDispatcher\Event;

class PriceChangedEvent extends Event
{
    public function __construct(
        private GameListing $gameListing,
        private float $oldPrice,
        private float $newPrice
    ) {}

    public function getGameListing(): GameListing
    {
        return $this->gameListing;
    }

    public function getOldPrice(): float
    {
        return $this->oldPrice;
    }

    public function getNewPrice(): float
    {
        return $this->newPrice;
    }
}