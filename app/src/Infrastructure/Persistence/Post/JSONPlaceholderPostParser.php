<?php

namespace App\Infrastructure\Persistence\Post;

use App\Domain\Author\Author;
use App\Domain\Author\AuthorId;
use App\Domain\Post\Post;
use App\Domain\Post\PostContent;
use App\Domain\Post\PostId;
use App\Domain\Post\PostTitle;

class JSONPlaceholderPostParser
{
    public function toDomain(array $jsonPlaceholderPost): Post
    {
        $postId = new PostId($jsonPlaceholderPost['id']);
        $title = new PostTitle($jsonPlaceholderPost['title']);
        $content = new PostContent($jsonPlaceholderPost['body']);
        $author = Author::createEmpty(new AuthorId($jsonPlaceholderPost['userId']));
        return new Post($postId, $author, $title, $content);
    }
}
