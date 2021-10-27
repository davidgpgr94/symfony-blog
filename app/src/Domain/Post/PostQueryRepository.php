<?php

namespace App\Domain\Post;

use App\Domain\Author\Author;

interface PostQueryRepository
{
    public function findAll(): PostsCollection;

    public function findById(PostId $id): ?Post;

    public function findByAuthor(Author $author): PostsCollection;
}
