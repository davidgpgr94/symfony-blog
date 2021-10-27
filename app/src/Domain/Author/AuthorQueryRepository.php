<?php

namespace App\Domain\Author;

interface AuthorQueryRepository
{
    public function findAll(): AuthorsCollection;

    public function findById(AuthorId $id): ?Author;
}
