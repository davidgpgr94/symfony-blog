<?php

namespace App\Application\GetPosts;

use App\Domain\Post\PostQueryRepository;
use App\Domain\Post\PostsCollection;

class GetPostsUseCase
{
    private PostQueryRepository $postRepository;

    public function __construct(PostQueryRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function search(GetPostsQuery $query): PostsCollection
    {
        if (!is_null($query->getPostId())) {
            $post = $this->postRepository->findById($query->getPostId());

            return is_null($post)
                ? new PostsCollection([])
                : new PostsCollection( [$post] );
        }

        return $this->postRepository->findAll();
    }
}
