<?php

namespace App\Infrastructure\Api\Controller;

use App\Infrastructure\Api\Response\BaseResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    public function response(BaseResponse $response): JsonResponse
    {
        return $this->json($response->getData(), $response->getStatus(), $response->getHeaders());
    }
}
