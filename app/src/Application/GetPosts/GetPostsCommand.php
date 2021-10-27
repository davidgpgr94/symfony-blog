<?php

namespace App\Application\GetPosts;

use App\Domain\Post\PostId;

class GetPostsCommand
{
    private ?PostId $postId;

    public function __construct(?PostId $postId = null) {
        $this->postId = $postId;
    }

    public function getPostId(): ?PostId
    {
        return $this->postId;
    }
}
