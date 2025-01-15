<?php

namespace App\Entity;

use App\Repository\WishlistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WishlistRepository::class)]
class Wishlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'wishlists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: GameListing::class, inversedBy: 'wishlists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameListing $gameListing = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?float $maxPrice = null;

    #[ORM\Column]
    private bool $notifyOnPriceChange = true;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;
        return $this;
    }

    public function getGameListing(): ?GameListing
    {
        return $this->gameListing;
    }

    public function setGameListing(?GameListing $gameListing): static
    {
        $this->gameListing = $gameListing;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getMaxPrice(): ?float
    {
        return $this->maxPrice;
    }

    public function setMaxPrice(?float $maxPrice): static
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    public function isNotifyOnPriceChange(): bool
    {
        return $this->notifyOnPriceChange;
    }

    public function setNotifyOnPriceChange(bool $notify): static
    {
        $this->notifyOnPriceChange = $notify;
        return $this;
    }
}
