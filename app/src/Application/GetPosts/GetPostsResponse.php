<?php

namespace App\Application\GetPosts;

use App\Domain\Post\PostsCollection;

class GetPostsResponse
{
    private PostsCollection $postsCollection;

    public function __construct(PostsCollection $postsCollection)
    {
        $this->postsCollection = $postsCollection;
    }

    public function getPostsCollection(): PostsCollection
    {
        return $this->postsCollection;
    }
}
