<?php

namespace App\Infrastructure\Api\Controller;

use App\Application\GetPosts\GetPostsCommand;
use App\Application\GetPosts\GetPostsUseCase;
use App\Domain\Post\PostId;
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
        $command = new GetPostsCommand();

        $posts = $getPostsUseCase->search($command);

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
        $command = new GetPostsCommand(new PostId($id));
        $posts = $getPostsUseCase->search($command);

        return $this->response(new GetPostResponse($posts->getFirst()));
    }
}
