<?php

namespace App\Shared\Criteria;

class Page
{
    private const ITEMS_PER_PAGE = 5;

    private Offset $offset;
    private ?Limit $limit;

    private function __construct(Offset $offset, ?Limit $limit)
    {
        $this->offset = $offset;
        $this->limit = $limit;
    }

    public function hasPagination(): bool
    {
        return is_null($this->limit);
    }

    public function getOffset(): Offset
    {
        return $this->offset;
    }

    public function getLimit(): ?Limit
    {
        return $this->limit;
    }

    public static function createPageNumber(int $pageNumber): Page
    {
        $offset = ($pageNumber - 1) * Page::ITEMS_PER_PAGE;

        return new self(new Offset($offset), Page::defaultLimit());
    }

    public static function firstPage(): Page
    {
        return new self(new Offset(0), Page::defaultLimit());
    }

    public static function withoutPagination(): Page
    {
        return new self(new Offset(0), null);
    }

    private static function defaultLimit(): Limit
    {
        return new Limit(Page::ITEMS_PER_PAGE);
    }
}