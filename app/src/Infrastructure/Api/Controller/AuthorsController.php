<?php

namespace App\Infrastructure\Api\Controller;

use App\Application\GetAuthors\GetAuthorsQuery;
use App\Application\GetAuthors\GetAuthorsUseCase;
use App\Domain\Author\AuthorId;
use App\Infrastructure\Api\Response\Errors\AuthorNotFound;
use App\Infrastructure\Api\Response\GetAuthorResponse;
use App\Infrastructure\Api\Response\GetAuthorsResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/authors")
 */
class AuthorsController extends BaseController
{
    /**
     * @Route("/", methods={"GET"}, name="get_all_authors")
     *
     * @param GetAuthorsUseCase $getAuthorsUseCase
     * @return JsonResponse
     */
    public function getAll(GetAuthorsUseCase $getAuthorsUseCase): JsonResponse
    {
        $query = new GetAuthorsQuery();

        $authors = $getAuthorsUseCase->search($query);

        return $this->response(new GetAuthorsResponse($authors));
    }

    /**
     * @Route("/{id}", methods={"GET"}, name="get_one_author", requirements={"id"="\d+"})
     *
     * @param int $id
     * @param GetAuthorsUseCase $getAuthorsUseCase
     * @return JsonResponse
     */
    public function getOne(int $id, GetAuthorsUseCase $getAuthorsUseCase): JsonResponse
    {
        $query = new GetAuthorsQuery(new AuthorId($id));

        $authors = $getAuthorsUseCase->search($query);

        if (is_null($authors->getFirst())) {
            return $this->response(new AuthorNotFound($id));
        }

        return $this->response(new GetAuthorResponse($authors->getFirst()));
    }
}
