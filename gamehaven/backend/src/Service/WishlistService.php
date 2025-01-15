<?php

namespace App\Service;

use App\Entity\Wishlist;
use App\Entity\GameListing;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class WishlistService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    public function addToWishlist(GameListing $listing, User $user): Wishlist
    {
        $existingWishlist = $this->entityManager->getRepository(Wishlist::class)
            ->findOneBy(['user' => $user, 'gameListing' => $listing]);

        if ($existingWishlist) {
            throw new \InvalidArgumentException('Item already in wishlist');
        }

        $wishlist = new Wishlist();
        $wishlist->setUser($user);
        $wishlist->setGameListing($listing);

        $this->entityManager->persist($wishlist);
        $this->entityManager->flush();

        return $wishlist;
    }

    public function removeFromWishlist(GameListing $listing, User $user): void
    {
        $wishlist = $this->entityManager->getRepository(Wishlist::class)
            ->findOneBy(['user' => $user, 'gameListing' => $listing]);

        if ($wishlist) {
            $this->entityManager->remove($wishlist);
            $this->entityManager->flush();
        }
    }

    public function getUserWishlist(User $user): array
    {
        return $this->entityManager->getRepository(Wishlist::class)
            ->findBy(['user' => $user]);
    }

    public function checkWishlistMatches(GameListing $listing): array
    {
        return $this->entityManager->getRepository(Wishlist::class)
            ->findBy(['gameListing' => $listing]);
    }

    public function getWishlistNotifications(User $user): array
    {
        $wishlists = $this->getUserWishlist($user);
        $notifications = [];
        
        foreach ($wishlists as $wishlist) {
            $listing = $wishlist->getGameListing();
            // Check for price changes or status updates
            if ($listing->getStatus() === 'active') {
                $notifications[] = [
                    'type' => 'price_alert',
                    'message' => sprintf('Game "%s" is available for %s', 
                        $listing->getTitle(), 
                        $listing->getPrice()
                    ),
                    'listing' => $listing
                ];
            }
        }
        
        return $notifications;
    }

    public function checkPriceDrops(): array
    {
        // Implementation for checking price drops and notifying users
        return $this->entityManager->getRepository(Wishlist::class)
            ->findPriceDrops();
    }
}
