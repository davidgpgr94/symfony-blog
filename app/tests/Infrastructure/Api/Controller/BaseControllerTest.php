<?php

namespace App\Tests\Infrastructure\Api\Controller;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

abstract class BaseControllerTest extends KernelTestCase
{
    public function assertEmptyJsonResponse(JsonResponse $jsonResponse)
    {
        $this->assertIsJsonResponse($jsonResponse);

        $this->assertEmpty(
            json_decode($jsonResponse->getContent())
        );
    }

    public function assertJsonResponseArrayLength(JsonResponse $jsonResponse, int $expectedLength)
    {
        $this->assertIsJsonResponse($jsonResponse);

        $this->assertIsArray(
            json_decode($jsonResponse->getContent())
        );

        $this->assertCount(
            $expectedLength,
            json_decode($jsonResponse->getContent())
        );
    }

    public function assertJsonResponseHasKey(JsonResponse $jsonResponse, string $key)
    {
        $this->assertIsJsonResponse($jsonResponse);

        $this->assertIsNotArray(
            json_decode($jsonResponse->getContent())
        );

        $this->assertArrayHasKey(
            $key,
            json_decode($jsonResponse->getContent(), true)
        );
    }

    protected function assertIsJsonResponse(JsonResponse $jsonResponse)
    {
        $this->assertJson($jsonResponse->getContent(), "Response content is not a json");
    }
}
