<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $imageUrl = null;

    #[ORM\ManyToOne(targetEntity: GameListing::class, inversedBy: 'images')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GameListing $gameListing = null;

    #[ORM\Column(length: 50)]
    private string $type = 'main';

    #[ORM\Column]
    private int $position = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;
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

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;
        return $this;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function setPosition(int $position): static
    {
        $this->position = $position;
        return $this;
    }
}
