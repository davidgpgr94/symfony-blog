<?php

namespace App\Infrastructure\Api\Response\Errors;

use App\Infrastructure\Api\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Response;

class BaseErrorResponse extends BaseResponse
{
    public function __construct(string $message, int $status = Response::HTTP_INTERNAL_SERVER_ERROR, array $headers = [])
    {
        parent::__construct(['message' => $message], $status, $headers);
    }
}
