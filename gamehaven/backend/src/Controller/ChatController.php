<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Repository\ChatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/chat', name: 'app_chat_')]
class ChatController extends AbstractController
{
    #[Route('/messages', name: 'messages', methods: ['GET'])]
    public function getMessages(ChatRepository $chatRepository): JsonResponse
    {
        $messages = $chatRepository->findLatestMessages();
        
        $formattedMessages = array_map(function($chat) {
            $user = $chat->getUser();
            return [
                'id' => $chat->getId(),
                'message' => $chat->getMessage(),
                'createdAt' => $chat->getCreatedAt()->format('Y-m-d H:i:s'),
                'user' => [
                    'id' => $user->getId(),
                    'username' => $user->getUserIdentifier(),
                    'avatarUrl' => $user->getAvatarUrl() ?? null
                ]
            ];
        }, $messages);

        return $this->json($formattedMessages);
    }

    #[Route('/messages', name: 'send_message', methods: ['POST'])]
    public function sendMessage(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->json(['message' => 'Unauthorized'], 401);
        }

        $data = json_decode($request->getContent(), true);
        if (!isset($data['message']) || empty($data['message'])) {
            return $this->json(['message' => 'Message cannot be empty'], 400);
        }

        $chat = new Chat();
        $chat->setMessage($data['message']);
        $chat->setUser($user);

        $em->persist($chat);
        $em->flush();

        return $this->json([
            'id' => $chat->getId(),
            'message' => $chat->getMessage(),
            'createdAt' => $chat->getCreatedAt()->format('Y-m-d H:i:s'),
            'user' => [
                'id' => $user->getId(),
                'username' => $user->getUserIdentifier(),
                'avatarUrl' => $user->getAvatarUrl() ?? null
            ]
        ], 201);
    }
}
