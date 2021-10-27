<?php

namespace App\Infrastructure\JSONPlaceholder;

class JSONPlaceholderGetRequest extends JSONPlaceholderRequest
{
    public function __construct(string $endpoint, $query = null)
    {
        parent::__construct($endpoint, 'GET', $query);
    }
}
