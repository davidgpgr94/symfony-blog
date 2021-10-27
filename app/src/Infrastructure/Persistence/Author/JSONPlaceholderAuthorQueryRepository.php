<?php

namespace App\Infrastructure\Persistence\Author;

use App\Domain\Author\Author;
use App\Domain\Author\AuthorId;
use App\Domain\Author\AuthorQueryRepository;
use App\Domain\Author\AuthorsCollection;
use App\Domain\Author\Errors\AuthorNotExists;
use App\Infrastructure\JSONPlaceholder\JSONPlaceholderAuthorsEndpointRequest;
use App\Infrastructure\JSONPlaceholder\JSONPlaceholderClient;

class JSONPlaceholderAuthorQueryRepository implements AuthorQueryRepository
{
    private JSONPlaceholderClient $jsonPlaceholderClient;
    private JSONPlaceholderAuthorParser $parser;

    public function __construct(
        JSONPlaceholderClient $jsonPlaceholderClient,
        JSONPlaceholderAuthorParser $parser
    )
    {
        $this->jsonPlaceholderClient = $jsonPlaceholderClient;
        $this->parser = $parser;
    }

    public function findAll(): AuthorsCollection
    {
        $remoteAuthors = $this->jsonPlaceholderClient->request(new JSONPlaceholderAuthorsEndpointRequest());
        $domainAuthorsArray = array_map(function ($remoteAuthor) {
            return $this->parser->toDomain($remoteAuthor);
        }, $remoteAuthors);

        return new AuthorsCollection($domainAuthorsArray);
    }

    public function findById(AuthorId $id): Author
    {
        $remoteAuthor = $this->jsonPlaceholderClient->request(new JSONPlaceholderAuthorsEndpointRequest($id));

        if (empty($remoteAuthor)) throw new AuthorNotExists($id);

        return $this->parser->toDomain($remoteAuthor);
    }
}
