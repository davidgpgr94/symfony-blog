<?php

namespace App\Infrastructure\Api\Response;

use App\Domain\Post\Post;
use Symfony\Component\HttpFoundation\Response;

class GetPostResponse extends BaseResponse
{
    public function __construct(Post $post, int $status = Response::HTTP_OK)
    {
        parent::__construct($post->asArray(), $status);
    }

}