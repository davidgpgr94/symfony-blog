<?php

namespace App\Infrastructure\Api\Response\Errors;

use Symfony\Component\HttpFoundation\Response;

class PostNotFound extends BaseErrorResponse
{
    public function __construct(int $postId)
    {
        parent::__construct("Post with id <{$postId}> not found", Response::HTTP_NOT_FOUND);
    }
}
