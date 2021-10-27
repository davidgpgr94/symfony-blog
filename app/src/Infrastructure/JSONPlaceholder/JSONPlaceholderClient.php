<?php

namespace App\Infrastructure\JSONPlaceholder;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class JSONPlaceholderClient
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function request(JSONPlaceholderRequest $request)
    {
        $options = [];

        if ($request->hasQuery()) {
            $options['query'] = $request->getQuery();
        }

        if ($request->hasBody()) {
            $options['json'] = $request->getBody();
        }

        $response = $this->client->request(
            $request->getMethod(),
            $request->getEndpoint(),
            $options
        );

        return $response->toArray(false);
    }
}
