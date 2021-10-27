<?php

namespace App\Infrastructure\JSONPlaceholder;

abstract class JSONPlaceholderRequest
{
    private string $endpoint;
    private string $method;
    private ?array $query;
    private ?array $body;

    public function __construct(string $endpoint, string $method = 'GET', $query = null, $body = null)
    {
        $this->endpoint = $endpoint;
        $this->method = $method;
        $this->query = $query;
        $this->body = $body;
    }

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function hasQuery(): bool
    {
        return !is_null($this->query);
    }

    public function getQuery(): ?array
    {
        return $this->query;
    }

    public function hasBody(): bool
    {
        return !is_null($this->body);
    }

    public function getBody(): ?array
    {
        return $this->body;
    }
}
