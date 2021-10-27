<?php

namespace App\Infrastructure\JSONPlaceholder;

use App\Domain\Post\PostId;

class JSONPlaceholderPostsEndpointRequest extends JSONPlaceholderGetRequest
{
    public function __construct(PostId $postId = null, $query = null)
    {
        $endpoint = is_null($postId)
            ? '/posts'
            : '/posts/'.$postId->getValue();

        parent::__construct($endpoint, $query);
    }
}
