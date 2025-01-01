<?php

namespace Lexik\Bundle\JWTAuthenticationBundle\Event;

/**
 * BeforeJWEComputationEvent event is dispatched just before the computation of the encrypted token.
 * This can be used to add or modify the JWE header parameters.
 *
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
class BeforeJWEComputationEvent
{
    private $header;

    /**
     * @param array<string, mixed> $header
     */
    public function __construct(array $header)
    {
        $this->header = $header;
    }

    public function setHeader(string $key, mixed $value): self
    {
        $this->header[$key] = $value;

        return $this;
    }

    public function removeHeader(string $key): self
    {
        unset($this->header[$key]);

        return $this;
    }

    /**
     * @return array<string, mixed>
     */
    public function getHeader(): array
    {
        return $this->header;
    }
}
