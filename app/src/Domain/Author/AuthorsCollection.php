<?php

namespace App\Domain\Author;

use App\Shared\Collection;

class AuthorsCollection extends Collection
{
    protected function type(): string
    {
        return Author::class;
    }
}
