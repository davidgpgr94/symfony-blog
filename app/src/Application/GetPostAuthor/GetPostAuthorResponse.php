<?php

namespace App\Application\GetPostAuthor;

use App\Domain\Author\Author;

class GetPostAuthorResponse
{
    private Author $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }
}
