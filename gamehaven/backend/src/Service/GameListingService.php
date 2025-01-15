<?php

namespace App\Service;

use App\Entity\GameListing;
use App\Entity\Image;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GameListingService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {}

    private const ALLOWED_PLATFORMS = ['PS5', 'PS4', 'Xbox Series X', 'Xbox One', 'Nintendo Switch', 'PC'];
    private const ALLOWED_CONDITIONS = ['new', 'like new', 'good', 'acceptable'];

    private function validateListingData(array $data): void
    {
        if (!isset($data['platform']) || !in_array($data['platform'], self::ALLOWED_PLATFORMS)) {
            throw new \InvalidArgumentException('Invalid platform');
        }

        if (!isset($data['condition']) || !in_array($data['condition'], self::ALLOWED_CONDITIONS)) {
            throw new \InvalidArgumentException('Invalid condition');
        }

        if (!isset($data['price']) || $data['price'] <= 0) {
            throw new \InvalidArgumentException('Invalid price');
        }
    }

    public function createListing(array $data, User $seller): GameListing
    {
        if (!isset($data['title']) || !isset($data['platform']) || 
            !isset($data['condition']) || !isset($data['price'])) {
            throw new \InvalidArgumentException('Missing required fields');
        }

        $this->validateListingData($data);

        $listing = new GameListing();
        $listing->setTitle($data['title']);
        $listing->setPlatform($data['platform']);
        $listing->setCondition($data['condition']);
        $listing->setPrice((float)$data['price']);
        $listing->setDescription($data['description'] ?? '');
        $listing->setSeller($seller);

        $this->entityManager->persist($listing);
        $this->entityManager->flush();

        return $listing;
    }

    public function updateListing(GameListing $listing, array $data): GameListing
    {
        if (isset($data['title'])) {
            $listing->setTitle($data['title']);
        }
        if (isset($data['platform'])) {
            $listing->setPlatform($data['platform']);
        }
        if (isset($data['condition'])) {
            $listing->setCondition($data['condition']);
        }
        if (isset($data['price'])) {
            $listing->setPrice((float)$data['price']);
        }
        if (isset($data['description'])) {
            $listing->setDescription($data['description']);
        }
        if (isset($data['status'])) {
            $listing->setStatus($data['status']);
        }

        $this->validateListingData($data);

        $this->entityManager->flush();

        return $listing;
    }

    public function deleteListing(GameListing $listing): void
    {
        $this->entityManager->remove($listing);
        $this->entityManager->flush();
    }

    public function addImage(GameListing $listing, string $imageUrl): Image
    {
        $image = new Image();
        $image->setImageUrl($imageUrl);
        $image->setGameListing($listing);

        $this->entityManager->persist($image);
        $this->entityManager->flush();

        return $image;
    }

    public function getListings(array $criteria = []): array
    {
        if (!empty($criteria['title']) || !empty($criteria['platform']) || 
            isset($criteria['maxPrice']) || isset($criteria['minPrice'])) {
            return $this->entityManager->getRepository(GameListing::class)
                ->findBySearchCriteria($criteria);
        }
        
        return $this->entityManager->getRepository(GameListing::class)
            ->findBy($criteria, ['createdAt' => 'DESC']);
    }

    public function getSellerListings(User $seller): array
    {
        return $this->entityManager->getRepository(GameListing::class)
            ->findBy(['seller' => $seller], ['createdAt' => 'DESC']);
    }

    public function validateListing(array $data): void
    {
        $required = ['title', 'platform', 'condition', 'price'];
        foreach ($required as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                throw new \InvalidArgumentException("Missing required field: $field");
            }
        }
        
        if ($data['price'] <= 0) {
            throw new \InvalidArgumentException('Price must be greater than 0');
        }
    }

    public function getListing(int $id): ?GameListing
    {
        return $this->entityManager->getRepository(GameListing::class)->find($id);
    }

    public function searchListings(array $criteria): array
    {
        return $this->entityManager->getRepository(GameListing::class)
            ->findBySearchCriteria($criteria);
    }

    public function getPopularListings(): array
    {
        return $this->entityManager->getRepository(GameListing::class)
            ->findPopularListings();
    }
}
