<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Repository\ChatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/api/chat', name: 'app_chat_')]
class ChatController extends AbstractController
{
    private function getFullAssetUrl(Request $request, string $path): string 
    {
        return '//' . $request->getHttpHost() . $path;
    }

    #[Route('/messages', name: 'messages', methods: ['GET'])]
    public function getMessages(Request $request, ChatRepository $chatRepository): JsonResponse
    {
        $messages = $chatRepository->findLatestMessages();
        
        $formattedMessages = array_map(function($chat) use ($request) {
            $user = $chat->getUser();
            return [
                'id' => $chat->getId(),
                'message' => $chat->getMessage(),
                'fileUrl' => $chat->getFileUrl() ? $this->getFullAssetUrl($request, $chat->getFileUrl()) : null,
                'fileType' => $chat->getFileType(),
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
        try {
            $user = $this->getUser();
            if (!$user) {
                return $this->json(['message' => 'Unauthorized'], 401);
            }

            $message = $request->request->get('message', '');
            /** @var UploadedFile|null $file */
            $file = $request->files->get('file');

            if (empty($message) && !$file) {
                return $this->json(['message' => 'Message or file is required'], 400);
            }

            $chat = new Chat();
            $chat->setMessage($message);
            $chat->setUser($user);

            if ($file) {
                $uploadDir = $this->getParameter('chat_files_directory');
                
                // Ensure directory exists and is writable
                if (!is_dir($uploadDir)) {
                    if (!mkdir($uploadDir, 0755, true) && !is_dir($uploadDir)) {
                        throw new \RuntimeException(sprintf('Directory "%s" could not be created', $uploadDir));
                    }
                }

                // Validate file type
                $mimeType = $file->getMimeType();
                $extension = strtolower($file->getClientOriginalExtension());
                
                $allowedTypes = [
                    'application/pdf' => ['pdf'],
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => ['docx']
                ];

                if (!isset($allowedTypes[$mimeType]) || !in_array($extension, $allowedTypes[$mimeType])) {
                    return $this->json([
                        'message' => 'Only PDF and DOCX files are allowed'
                    ], 400);
                }

                // Clean the original filename
                $originalName = $file->getClientOriginalName();
                $safeName = preg_replace('/[^a-zA-Z0-9_.-]/', '_', $originalName);
                
                // Add unique identifier to prevent overwriting
                $newFilename = sprintf('%s-%s', 
                    uniqid(),
                    $safeName
                );

                try {
                    $file->move($uploadDir, $newFilename);
                    $fileUrl = '/uploads/chat/' . $newFilename;
                    $chat->setFileUrl($fileUrl);
                    $chat->setFileType($mimeType);
                    chmod($uploadDir . '/' . $newFilename, 0644);
                } catch (\Exception $e) {
                    throw new \RuntimeException('Failed to upload file: ' . $e->getMessage());
                }
            }

            $em->persist($chat);
            $em->flush();

            return $this->json([
                'id' => $chat->getId(),
                'message' => $chat->getMessage(),
                'fileUrl' => $chat->getFileUrl() ? $this->getFullAssetUrl($request, $chat->getFileUrl()) : null,
                'fileType' => $chat->getFileType(),
                'createdAt' => $chat->getCreatedAt()->format('Y-m-d H:i:s'),
                'user' => [
                    'id' => $user->getId(),
                    'username' => $user->getUserIdentifier(),
                    'avatarUrl' => $user->getAvatarUrl() ?? null
                ]
            ], 201);

        } catch (\Exception $e) {
            return $this->json([
                'message' => 'Upload error: ' . $e->getMessage()
            ], 500);
        }
    }
}
