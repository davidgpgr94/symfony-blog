<?php

namespace App\Shared\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class LinksFilter extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('full_url', [$this, 'fullUrl']),
            new TwigFilter('mail', [$this, 'mailToLink']),
            new TwigFilter('phone', [$this, 'phoneLink']),
        ];
    }

    public function fullUrl(string $url): string
    {
        return strpos($url, 'http') !== 0 ? 'http://'.$url : $url;
    }

    public function mailToLink(string $mail): string
    {
        return "mailto:{$mail}";
    }

    public function phoneLink(string $phone): string
    {
        return "tel:{$phone}";
    }
}