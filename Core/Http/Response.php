<?php

namespace Core\Http;

use Core\Interfaces\MessageInterface;
use Core\Interfaces\ResponseInterface;

class Response implements ResponseInterface, MessageInterface
{
    private int $statusCode;

    private array $headers;

    private array $body;

    public function __construct($statusCode, $body)
    {
        $this->statusCode = $statusCode;
        $this->body = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
