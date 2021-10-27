<?php

namespace App\Domain\Post;

use App\Domain\Author\Author;
use App\Domain\Post\Errors\PostNotExists;

interface PostQueryRepository
{
    public function findAll(): PostsCollection;

    /**
     * @param PostId $id
     * @return Post
     * @throws PostNotExists
     */
    public function findById(PostId $id): Post;

    public function findByAuthor(Author $author): PostsCollection;
}
