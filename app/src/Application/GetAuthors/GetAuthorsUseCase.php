<?php

namespace App\Application\GetAuthors;

use App\Domain\Author\AuthorQueryRepository;
use App\Domain\Author\AuthorsCollection;
use App\Domain\Author\Errors\AuthorNotExists;

class GetAuthorsUseCase
{
    private AuthorQueryRepository $authorRepository;

    public function __construct(AuthorQueryRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param GetAuthorsQuery $query
     * @return AuthorsCollection
     * @throws AuthorNotExists
     */
    public function search(GetAuthorsQuery $query): AuthorsCollection
    {
        if (!is_null($query->getAuthorId())) {
            $author = $this->authorRepository->findById($query->getAuthorId());

            return new AuthorsCollection( [$author] );
        }

        return $this->authorRepository->findAll();
    }
}
