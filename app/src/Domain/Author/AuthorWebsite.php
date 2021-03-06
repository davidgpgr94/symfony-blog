<?php

namespace App\Domain\Author;

use App\Shared\ValueObject\NotBlankStringValueObject;
use InvalidArgumentException;

class AuthorWebsite extends NotBlankStringValueObject
{
    public function __construct(string $url)
    {
        $this->ensureIsValidUrl($url);

        parent::__construct($url);
    }

    private function ensureIsValidUrl(string $url)
    {
        $fixedUrl = strpos($url, 'http') !== 0 ? 'http://'.$url : $url;

        if (false === filter_var($fixedUrl, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException(sprintf('The url <%s> is not valid', $url));
        }
    }
}