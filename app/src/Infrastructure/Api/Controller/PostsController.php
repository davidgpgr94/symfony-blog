<?php

namespace App\Infrastructure\Api\Controller;

use App\Application\GetPostAuthor\GetPostAuthorQuery;
use App\Application\GetPostAuthor\GetPostAuthorUseCase;
use App\Application\GetPosts\GetPostsQuery;
use App\Application\GetPosts\GetPostsUseCase;
use App\Domain\Author\Errors\AuthorNotExists;
use App\Domain\Post\Errors\PostNotExists;
use App\Domain\Post\PostId;
use App\Infrastructure\Api\Response\Errors\AuthorNotFound;
use App\Infrastructure\Api\Response\Errors\PostNotFound;
use App\Infrastructure\Api\Response\GetAuthorResponse;
use App\Infrastructure\Api\Response\GetPostResponse;
use App\Infrastructure\Api\Response\GetPostsResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/posts")
 */
class PostsController extends BaseController
{

    /**
     * @Route("/", methods={"GET"}, name="get_all_posts")
     *
     * @param GetPostsUseCase $getPostsUseCase
     * @return JsonResponse
     */
    public function getAll(GetPostsUseCase $getPostsUseCase): JsonResponse
    {
        $query = new GetPostsQuery();

        $posts = $getPostsUseCase->search($query);

        return $this->response(new GetPostsResponse($posts));
    }

    /**
     * @Route("/{id}", methods={"GET"}, name="get_one_post", requirements={"id"="\d+"})
     *
     * @param int $id
     * @param GetPostsUseCase $getPostsUseCase
     * @return JsonResponse
     */
    public function getOne(int $id, GetPostsUseCase $getPostsUseCase): JsonResponse
    {
        $query = new GetPostsQuery(new PostId($id));

        try {
            $posts = $getPostsUseCase->search($query);

            return $this->response(new GetPostResponse($posts->getFirst()));
        } catch (PostNotExists $postNotExists) {
            return $this->response(new PostNotFound($id));
        }
    }

    /**
     * @Route("/{postId}/author", methods={"GET"}, name="get_post_author", requirements={"postId"="\d+"})
     *
     * @param int $postId
     * @param GetPostAuthorUseCase $getPostAuthorUseCase
     * @return JsonResponse
     */
    public function getPostAuthor(int $postId, GetPostAuthorUseCase $getPostAuthorUseCase): JsonResponse
    {
        $query = new GetPostAuthorQuery(new PostId($postId));

        try {
            $author = $getPostAuthorUseCase->search($query);

            return $this->response(new GetAuthorResponse($author));
        } catch (PostNotExists $postNotExists) {
            return $this->response(new PostNotFound($postId));
        }
    }
}
