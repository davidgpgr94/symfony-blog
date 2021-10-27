<?php

namespace App\Infrastructure\Api\Response;

use App\Domain\Author\AuthorsCollection;
use App\Shared\Arrayable;
use Symfony\Component\HttpFoundation\Response;

class GetAuthorsResponse extends BaseResponse
{
    public function __construct(AuthorsCollection $authors, int $status = Response::HTTP_OK)
    {
        $authorsArray = array_map(function ($author) {
            /** @var $author Arrayable */
            return $author->asArray();
        }, $authors->items());

        parent::__construct($authorsArray, $status);
    }
}
