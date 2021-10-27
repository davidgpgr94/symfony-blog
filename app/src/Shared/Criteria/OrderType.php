<?php

namespace App\Shared\Criteria;

use App\Shared\ValueObject\StringValueObject;

class OrderType extends StringValueObject
{
    protected const ASC = 'asc';
    protected const DESC = 'desc';
    protected const NO_ORDER = 'no-order';

    private function __construct($type)
    {
        parent::__construct($type);
    }

    public function withOrder(): bool
    {
        return OrderType::NO_ORDER !== $this->getValue();
    }

    public static function asc(): OrderType
    {
        return new self(OrderType::ASC);
    }

    public static function desc(): OrderType
    {
        return new self(OrderType::DESC);
    }

    public static function withoutOrder(): OrderType
    {
        return new self(OrderType::NO_ORDER);
    }
}
