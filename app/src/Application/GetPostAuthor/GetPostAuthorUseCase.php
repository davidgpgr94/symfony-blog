<?php

namespace App\Application\GetPostAuthor;

use App\Domain\Author\Author;
use App\Domain\Author\AuthorQueryRepository;
use App\Domain\Author\Errors\AuthorNotExists;
use App\Domain\Post\Errors\PostNotExists;
use App\Domain\Post\PostQueryRepository;

class GetPostAuthorUseCase
{
    private PostQueryRepository $postQueryRepository;
    private AuthorQueryRepository $authorQueryRepository;

    public function __construct(PostQueryRepository $postQueryRepository, AuthorQueryRepository $authorQueryRepository)
    {
        $this->postQueryRepository = $postQueryRepository;
        $this->authorQueryRepository = $authorQueryRepository;
    }

    /**
     * @param GetPostAuthorQuery $query
     * @return Author
     * @throws PostNotExists
     * @throws AuthorNotExists
     */
    public function search(GetPostAuthorQuery $query): Author
    {
        $post = $this->postQueryRepository->findById($query->getPostId());

        return $this->authorQueryRepository->findById($post->getAuthor()->getId());
    }
}
