<?php

namespace App\Domain\Author;

use App\Domain\Author\Errors\AuthorNotExists;

interface AuthorQueryRepository
{
    public function findAll(): AuthorsCollection;

    /**
     * @param AuthorId $id
     * @return Author
     * @throws AuthorNotExists
     */
    public function findById(AuthorId $id): Author;
}
