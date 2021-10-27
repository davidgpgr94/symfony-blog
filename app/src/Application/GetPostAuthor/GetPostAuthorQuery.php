<?php

namespace App\Application\GetPostAuthor;

use App\Domain\Post\PostId;

class GetPostAuthorQuery
{
    private PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
    }

    public function getPostId(): PostId
    {
        return $this->postId;
    }
}
