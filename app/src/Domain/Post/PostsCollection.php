<?php

namespace App\Domain\Post;

use App\Shared\Collection;

class PostsCollection extends Collection
{
    protected function type(): string
    {
        return Post::class;
    }
}