<?php

namespace App\Tests\Infrastructure\Api\Controller;

use App\Application\GetPosts\GetPostsUseCase;
use App\Domain\Author\Author;
use App\Domain\Author\AuthorId;
use App\Domain\Post\Errors\PostNotExists;
use App\Domain\Post\Post;
use App\Domain\Post\PostContent;
use App\Domain\Post\PostId;
use App\Domain\Post\PostsCollection;
use App\Domain\Post\PostTitle;
use App\Infrastructure\Api\Controller\PostsController;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\DependencyInjection\ContainerInterface;

class PostsControllerTest extends BaseControllerTest
{
    private static PostsCollection $emptyPostsCollection;
    private static PostsCollection $filledPostsCollection;
    private static PostId $postIdFirstPost;
    private static Post $firstPost;
    private static PostId $postIdSecondPost;
    private static Post $secondPost;

    private ContainerInterface $testContainer;

    /** @var GetPostsUseCase|MockObject */
    private  $getPostsUseCaseMocked;

    public static function setUpBeforeClass(): void
    {
        static::$postIdFirstPost = new PostId(1);
        static::$firstPost = new Post(
            static::$postIdFirstPost,
            Author::createEmpty(new AuthorId(1)),
            new PostTitle('The first post title'),
            new PostContent('The first post content')
        );
        static::$postIdSecondPost = new PostId(2);
        static::$secondPost = new Post(
            static::$postIdSecondPost,
            Author::createEmpty(new AuthorId(1)),
            new PostTitle('The second post title'),
            new PostContent('The second post content')
        );

        static::$emptyPostsCollection = new PostsCollection([]);
        static::$filledPostsCollection = new PostsCollection([
            static::$firstPost, static::$secondPost
        ]);
    }

    public function setUp(): void
    {
        $this->testContainer = static::getContainer();
        $this->getPostsUseCaseMocked = $this->getMockBuilder(GetPostsUseCase::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['search'])
            ->getMock();
    }

    /** @test */
    public function itShouldReturnAnEmptyJsonResponse()
    {
        $this->getPostsUseCaseMocked->method('search')
            ->willReturn(static::$emptyPostsCollection);

        $this->testContainer->set(GetPostsUseCase::class, $this->getPostsUseCaseMocked);

        $postController = $this->testContainer->get(PostsController::class);

        $jsonResponse = $postController->getAll($this->getPostsUseCaseMocked);

        $this->assertEmptyJsonResponse($jsonResponse);
    }

    /** @test */
    public function itShouldReturnJsonResponseWithTwoPosts()
    {
        $this->getPostsUseCaseMocked->method('search')
            ->willReturn(static::$filledPostsCollection);

        $this->testContainer->set(GetPostsUseCase::class, $this->getPostsUseCaseMocked);

        $postController = $this->testContainer->get(PostsController::class);

        $jsonResponse = $postController->getAll($this->getPostsUseCaseMocked);

        $this->assertJsonResponseArrayLength($jsonResponse, static::$filledPostsCollection->count());
    }

    /** @test */
    public function itShouldReturnJsonResponseWithMessageKey()
    {
        $this->getPostsUseCaseMocked->method('search')
            ->willThrowException(new PostNotExists(static::$postIdSecondPost));

        $this->testContainer->set(GetPostsUseCase::class, $this->getPostsUseCaseMocked);

        $postController = $this->testContainer->get(PostsController::class);

        $jsonResponse = $postController->getOne(2, $this->getPostsUseCaseMocked);

        $this->assertJson($jsonResponse->getContent());

        $this->assertJsonResponseHasKey($jsonResponse, 'message');

        $this->assertSame(404, $jsonResponse->getStatusCode());
    }
}
