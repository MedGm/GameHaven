<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\Wishlist;
use App\Repository\WishlistRepository;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/wishlist', name: 'app_wishlist_')]
final class WishlistController extends AbstractController
{
    public function __construct(
        private WishlistRepository $wishlistRepository,
        private UserRepository $userRepository,
        private GameRepository $gameRepository,
        private EntityManagerInterface $entityManager
    ) {}

    #[Route('', methods: ['GET'])]
    public function getUserWishlist(WishlistRepository $repo): JsonResponse
    {
        $user = $this->getUser();
        return $this->json($repo->findBy(['user' => $user]));
    }

    #[Route('/{gameId}', methods: ['POST'])]
    public function addToWishlist(
        int $gameId,
        GameRepository $gameRepo,
        EntityManagerInterface $em
    ): JsonResponse
    {
        $game = $gameRepo->find($gameId);
        if (!$game) {
            return $this->json(['message' => 'Game not found'], 404);
        }

        $wishlist = new Wishlist();
        $wishlist->setUser($this->getUser());
        $wishlist->setGame($game);
        $wishlist->setAddedAt();

        $em->persist($wishlist);
        $em->flush();

        return $this->json(['message' => 'Added to wishlist']);
    }

    #[Route('/{gameId}', methods: ['DELETE'])]
    public function removeFromWishlist(
        int $gameId,
        WishlistRepository $repo,
        EntityManagerInterface $em
    ): JsonResponse
    {
        $wishlistItem = $repo->findOneBy([
            'user' => $this->getUser(),
            'game' => $gameId
        ]);

        if (!$wishlistItem) {
            return $this->json(['message' => 'Item not found in wishlist'], 404);
        }

        $em->remove($wishlistItem);
        $em->flush();

        return $this->json(['message' => 'Removed from wishlist']);
    }
}
