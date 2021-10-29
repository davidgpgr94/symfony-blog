<?php

namespace App\Infrastructure\BlogFront\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class BaseWebController extends AbstractController
{
    public function response(string $template, array $params = []): Response
    {
        return $this->render($template, $this->getParameters($params));
    }

    private function getParameters(array $params = []): array
    {
        return array_merge(
            ['title' => 'Symfony Blog'],
            $params
        );
    }
}
