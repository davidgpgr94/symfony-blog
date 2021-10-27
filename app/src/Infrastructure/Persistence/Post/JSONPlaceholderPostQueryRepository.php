<?php

namespace App\Infrastructure\Persistence\Post;

use App\Domain\Author\Author;
use App\Domain\Post\Post;
use App\Domain\Post\PostId;
use App\Domain\Post\PostQueryRepository;
use App\Domain\Post\PostsCollection;
use App\Infrastructure\JSONPlaceholder\JSONPlaceholderClient;
use App\Infrastructure\JSONPlaceholder\JSONPlaceholderPostsEndpointRequest;

class JSONPlaceholderPostQueryRepository implements PostQueryRepository
{
    private JSONPlaceholderPostParser $parser;
    private JSONPlaceholderClient $jsonPlaceholderClient;

    public function __construct(
        JSONPlaceholderClient $jsonPlaceholderClient,
        JSONPlaceholderPostParser $parser
    )
    {
        $this->jsonPlaceholderClient = $jsonPlaceholderClient;
        $this->parser = $parser;
    }

    public function findAll(): PostsCollection
    {
        $remotePosts = $this->jsonPlaceholderClient->request(new JSONPlaceholderPostsEndpointRequest());
        $domainPostsArray = array_map(function ($remotePost) {
            return $this->parser->toDomain($remotePost);
        }, $remotePosts);

        return new PostsCollection($domainPostsArray);
    }

    public function findById(PostId $id): ?Post
    {
        $remotePost = $this->jsonPlaceholderClient->request(new JSONPlaceholderPostsEndpointRequest($id));

        return empty($remotePost)
            ? null
            : $this->parser->toDomain($remotePost);
    }

    public function findByAuthor(Author $author): PostsCollection
    {
        $request = new JSONPlaceholderPostsEndpointRequest(
            null,
            ['userId' => $author->getId()->getValue()]
        );
        $remotePosts = $this->jsonPlaceholderClient->request($request);

        $domainPostsArray = array_map(function ($remotePost) {
            return $this->parser->toDomain($remotePost);
        }, $remotePosts);

        return new PostsCollection($domainPostsArray);
    }
}
