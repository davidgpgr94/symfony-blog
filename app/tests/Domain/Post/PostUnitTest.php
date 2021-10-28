<?php

namespace App\Tests\Domain\Post;

use App\Domain\Author\Author;
use App\Domain\Author\AuthorId;
use App\Domain\Post\Post;
use App\Domain\Post\PostContent;
use App\Domain\Post\PostId;
use App\Domain\Post\PostTitle;
use PHPUnit\Framework\TestCase;

class PostUnitTest extends TestCase
{
    private Post $postWithAuthorId;
    private array $keysPostMustHaveAsArray = [ 'id', 'title', 'content', 'author' ];

    /** @before */
    public function setUpValidPost(): void
    {
        $this->postWithAuthorId = new Post(
            new PostId(1),
            Author::createEmpty(new AuthorId(1)),
            new PostTitle('The post title'),
            new PostContent('The post content')
        );
    }

    /** @test */
    public function asArrayShouldReturnThePostAsArray()
    {
        $postAsArray = $this->postWithAuthorId->asArray();

        $this->assertIsArray($postAsArray);

        foreach ($this->keysPostMustHaveAsArray as $keyPostMustHave) {
            $this->assertArrayHasKey($keyPostMustHave, $postAsArray, "Missing key <{$keyPostMustHave}>");
        }
    }
}
