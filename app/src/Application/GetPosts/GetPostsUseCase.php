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

    public function search(GetPostsCommand $command): PostsCollection
    {
        if (!is_null($command->getPostId())) {
            $post = $this->postRepository->findById($command->getPostId());
            return new PostsCollection( [$post] );
        }

        return $this->postRepository->findAll();
    }
}
