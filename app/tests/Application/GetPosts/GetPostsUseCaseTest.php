<?php

namespace App\Tests\Application\GetPosts;

use App\Application\GetPosts\GetPostsQuery;
use App\Application\GetPosts\GetPostsUseCase;
use App\Domain\Author\Author;
use App\Domain\Author\AuthorId;
use App\Domain\Post\Errors\PostNotExists;
use App\Domain\Post\Post;
use App\Domain\Post\PostContent;
use App\Domain\Post\PostId;
use App\Domain\Post\PostQueryRepository;
use App\Domain\Post\PostsCollection;
use App\Domain\Post\PostTitle;
use PHPUnit\Framework\TestCase;

class GetPostsUseCaseTest extends TestCase
{
    private static PostId $postIdNotExists;
    private static PostId $postIdFirstPost;
    private static PostId $postIdSecondPost;

    /** @beforeClass */
    public static function setUpPostIds(): void
    {
        self::$postIdNotExists = new PostId(9999);
        self::$postIdFirstPost = new PostId(1);
        self::$postIdSecondPost = new PostId(2);
    }

    private PostsCollection $postsCollection;
    private Post $firstPost;
    private Post $secondPost;

    public function setUpPostsCollection()
    {
        $this->firstPost = new Post(
            static::$postIdFirstPost,
            Author::createEmpty(new AuthorId(1)),
            new PostTitle('The first post title'),
            new PostContent('The first post content')
        );
        $this->secondPost = new Post(
            static::$postIdSecondPost,
            Author::createEmpty(new AuthorId(1)),
            new PostTitle('The second post title'),
            new PostContent('The second post content')
        );

        $this->postsCollection = new PostsCollection([
            $this->firstPost,
            $this->secondPost
        ]);
    }

    private PostQueryRepository $mockPostRepository;
    private GetPostsUseCase $getPostsUseCase;

    public function setUpPostRepositoryMockAndGetPostsUseCase()
    {
        $this->mockPostRepository = $this->createMock(PostQueryRepository::class);

        $this->mockPostRepository->expects($this->any())
            ->method('findAll')
            ->willReturn($this->postsCollection);

        $this->mockPostRepository->expects($this->any())
            ->method('findById')
            ->with(
                $this->callback(function (PostId $postId) {
                    $postsIdToTest = [static::$postIdNotExists, static::$postIdFirstPost, static::$postIdSecondPost];
                    return in_array($postId, $postsIdToTest);
                })
            )
            ->willReturnCallback(function (PostId $postId) {
                if ($postId->getValue() === static::$postIdNotExists->getValue()) {
                    throw new PostNotExists(static::$postIdNotExists);
                }

                if ($postId->getValue() === 1) return $this->firstPost;
                return $this->secondPost;
            });

        $this->getPostsUseCase = new GetPostsUseCase($this->mockPostRepository);
    }

    public function setUp(): void
    {
        $this->setUpPostsCollection();
        $this->setUpPostRepositoryMockAndGetPostsUseCase();
    }

    /** @test */
    public function itShouldReturnAllPostsWhenQueryHasNotPostId()
    {
        $query = new GetPostsQuery();
        $posts = $this->getPostsUseCase->search($query);

        $this->assertEqualsCanonicalizing(
            $this->postsCollection->items(),
            $posts->items()
        );
    }

    /** @test */
    public function itShouldReturnThePostInsidePostCollection()
    {
        $query = new GetPostsQuery(static::$postIdSecondPost);

        $response = $this->getPostsUseCase->search($query);

        $this->assertEquals($this->secondPost, $response->getFirst());
    }

    /** @test */
    public function itShouldThrowPostNotExists()
    {
        $query = new GetPostsQuery(static::$postIdNotExists);

        $this->expectException(PostNotExists::class);

        $this->getPostsUseCase->search($query);
    }
}
