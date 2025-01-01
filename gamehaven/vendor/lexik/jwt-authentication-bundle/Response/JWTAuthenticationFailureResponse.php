<?php

namespace Lexik\Bundle\JWTAuthenticationBundle\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * JWTAuthenticationFailureResponse.
 *
 * Response sent on failed JWT authentication (can be replaced by a custom Response).
 *
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
final class JWTAuthenticationFailureResponse extends JsonResponse
{
    private string $message;

    public function __construct(string $message = 'Bad credentials', int $statusCode = Response::HTTP_UNAUTHORIZED)
    {
        $this->message = $message;

        parent::__construct(null, $statusCode, ['WWW-Authenticate' => 'Bearer']);
    }

    /**
     * Sets the response data with the statusCode & message included.
     */
    public function setData(mixed $data = []): static
    {
        return parent::setData((array)$data + ["code" => $this->statusCode, "message" => $this->getMessage()]);
    }

    /**
     * Sets the failure message.
     */
    public function setMessage(string $message): JWTAuthenticationFailureResponse
    {
        $this->message = $message;

        $this->setData();

        return $this;
    }

    /**
     * Gets the failure message.
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
