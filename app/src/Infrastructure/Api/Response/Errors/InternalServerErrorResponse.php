<?php

namespace App\Infrastructure\Api\Response\Errors;

use Symfony\Component\HttpFoundation\Response;

class InternalServerErrorResponse extends BaseErrorResponse
{
    public function __construct(string $message = 'Internal server error')
    {
        parent::__construct($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
