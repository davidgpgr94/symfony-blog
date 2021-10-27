<?php

namespace App\Shared\Criteria;

class Order
{
    private OrderBy $orderBy;
    private OrderType $orderType;

    public function __construct(OrderBy $orderBy, OrderType $orderType)
    {
        $this->orderBy = $orderBy;
        $this->orderType = $orderType;
    }

    public function hasOrder(): bool
    {
        return $this->getOrderType()->withOrder();
    }

    public function getOrderBy(): OrderBy
    {
        return $this->orderBy;
    }

    public function getOrderType(): OrderType
    {
        return $this->orderType;
    }

    public static function createWithoutOrder(): Order
    {
        return new self(new OrderBy(''), OrderType::withoutOrder());
    }
}
