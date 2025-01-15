<?php

namespace App\Entity;

use App\Repository\GameListingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameListingRepository::class)]
class GameListing
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 50)]
    private ?string $platform = null;

    #[ORM\Column(name: 'game_condition', length: 50)]  // Changed column name
    private ?string $condition = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column(length: 50)]
    private ?string $status = 'active';

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'listings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $seller = null;

    #[ORM\OneToMany(mappedBy: 'gameListing', targetEntity: Image::class, cascade: ['persist', 'remove'])]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'gameListing', targetEntity: Wishlist::class)]
    private Collection $wishlists;

    #[ORM\Column(type: 'json', nullable: true)]
    private ?array $priceHistory = [];

    #[ORM\OneToMany(mappedBy: 'gameListing', targetEntity: Transaction::class)]
    private Collection $transactions;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->wishlists = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->transactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): static
    {
        $this->platform = $platform;
        return $this;
    }

    public function getCondition(): ?string
    {
        return $this->condition;
    }

    public function setCondition(string $condition): static
    {
        $this->condition = $condition;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getSeller(): ?User
    {
        return $this->seller;
    }

    public function setSeller(?User $seller): static
    {
        $this->seller = $seller;
        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setGameListing($this);
        }
        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            if ($image->getGameListing() === $this) {
                $image->setGameListing(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Wishlist>
     */
    public function getWishlists(): Collection
    {
        return $this->wishlists;
    }

    public function addWishlist(Wishlist $wishlist): static
    {
        if (!$this->wishlists->contains($wishlist)) {
            $this->wishlists->add($wishlist);
            $wishlist->setGameListing($this);
        }
        return $this;
    }

    public function removeWishlist(Wishlist $wishlist): static
    {
        if ($this->wishlists->removeElement($wishlist)) {
            if ($wishlist->getGameListing() === $this) {
                $wishlist->setGameListing(null);
            }
        }
        return $this;
    }

    public function updatePrice(float $newPrice): static
    {
        if ($this->price !== $newPrice) {
            $this->priceHistory[] = [
                'price' => $this->price,
                'date' => (new \DateTimeImmutable())->format('Y-m-d H:i:s')
            ];
            $this->price = $newPrice;
        }
        return $this;
    }

    public function getPriceHistory(): ?array
    {
        return $this->priceHistory;
    }
}
