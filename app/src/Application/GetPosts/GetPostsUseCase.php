<?php

namespace App\Application\GetPosts;

use App\Domain\Post\Errors\PostNotExists;
use App\Domain\Post\PostQueryRepository;
use App\Domain\Post\PostsCollection;

class GetPostsUseCase
{
    private PostQueryRepository $postRepository;

    public function __construct(PostQueryRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param GetPostsQuery $query
     * @return PostsCollection
     * @throws PostNotExists
     */
    public function search(GetPostsQuery $query): PostsCollection
    {
        if (!is_null($query->getPostId())) {
            $post = $this->postRepository->findById($query->getPostId());

            return new PostsCollection( [$post] );
        }

        return $this->postRepository->findAll();
    }
}
