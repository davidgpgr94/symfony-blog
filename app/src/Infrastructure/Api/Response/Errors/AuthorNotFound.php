<?php

namespace App\Infrastructure\Api\Response\Errors;

use Symfony\Component\HttpFoundation\Response;

class AuthorNotFound extends BaseErrorResponse
{
    public function __construct(int $authorId)
    {
        parent::__construct("Author with id <{$authorId}> not found", Response::HTTP_NOT_FOUND);
    }
}
