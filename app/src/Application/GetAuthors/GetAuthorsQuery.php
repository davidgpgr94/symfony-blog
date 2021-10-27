<?php

namespace App\Application\GetAuthors;

use App\Domain\Author\AuthorId;

class GetAuthorsQuery
{
    private ?AuthorId $authorId;

    public function __construct(?AuthorId $authorId = null)
    {
        $this->authorId = $authorId;
    }

    public function getAuthorId(): ?AuthorId
    {
        return $this->authorId;
    }
}