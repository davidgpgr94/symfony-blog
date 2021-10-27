<?php

namespace App\Shared\Criteria;

use App\Shared\Collection;

class Filters extends Collection
{
    protected function type(): string
    {
        return Filter::class;
    }

    public static function createEmpty(): Filters
    {
        return new self([]);
    }
}