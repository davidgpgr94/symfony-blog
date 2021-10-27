<?php

namespace App\Infrastructure\JSONPlaceholder;

use App\Domain\Author\AuthorId;

class JSONPlaceholderAuthorsEndpointRequest extends JSONPlaceholderGetRequest
{
    public function __construct(AuthorId $authorId = null, $query = null)
    {
        $endpoint = is_null($authorId)
            ? '/users'
            : '/users/'.$authorId->getValue();

        parent::__construct($endpoint, $query);
    }
}