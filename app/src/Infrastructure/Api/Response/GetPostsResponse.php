<?php

namespace App\Infrastructure\Api\Response;

use App\Domain\Post\PostsCollection;
use App\Shared\Arrayable;
use Symfony\Component\HttpFoundation\Response;

class GetPostsResponse extends BaseResponse
{
    public function __construct(PostsCollection $posts, int $status = Response::HTTP_OK)
    {
        $postsArray = array_map(function ($post) {
            /** @var $post Arrayable */
            return $post->asArray();
        }, $posts->items());
        parent::__construct($postsArray, $status);
    }
}
