<?php

namespace App\Infrastructure\Api\Response;

use App\Domain\Author\Author;
use Symfony\Component\HttpFoundation\Response;

class GetAuthorResponse extends BaseResponse
{
    public function __construct(Author $author, int $status = Response::HTTP_OK)
    {
        parent::__construct($author->asArray(), $status);
    }
}
