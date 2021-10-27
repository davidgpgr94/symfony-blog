<?php

namespace App\Shared\Criteria;

class Criteria
{
    private Filters $filters;
    private Order $order;
    private Page $page;

    public function __construct(Filters $filters, Order $order, Page $page)
    {
        $this->filters = $filters;
        $this->order = $order;
        $this->page = $page;
    }

    public function getFilters(): Filters
    {
        return $this->filters;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getPage(): Page
    {
        return $this->page;
    }

    public static function createEmpty(): Criteria
    {
        return new self(
            Filters::createEmpty(),
            Order::createWithoutOrder(),
            Page::withoutPagination()
        );
    }
}
