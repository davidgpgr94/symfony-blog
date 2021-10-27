<?php

namespace App\Infrastructure\Api\Response;

use Symfony\Component\HttpFoundation\Response;

class BaseResponse
{
    private $data;
    private int $status;
    private array $headers;

    public function __construct($data, int $status = Response::HTTP_OK, array $headers = [])
    {
        $this->data = $data;
        $this->status = $status;
        $this->headers = $headers;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }
}
