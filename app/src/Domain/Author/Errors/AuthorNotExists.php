<?php

namespace App\Domain\Author\Errors;

use App\Domain\Author\AuthorId;
use App\Domain\Shared\DomainError;

class AuthorNotExists extends DomainError
{
    private AuthorId $authorId;

    public function __construct(AuthorId $authorId)
    {
        $this->authorId = $authorId;
        parent::__construct();
    }

    protected function errorMessage(): string
    {
        return "The author {$this->authorId->getValue()} does not exist";
    }
}
