<?php

namespace App\Domain\Author;

use App\Shared\ValueObject\NotBlankStringValueObject;
use InvalidArgumentException;

class AuthorEmail extends NotBlankStringValueObject
{
    public function __construct(string $email)
    {
        $this->ensureIsValidEmail($email);

        parent::__construct($email);
    }

    private function ensureIsValidEmail(string $email): void
    {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf('The email <%s> is not valid', $email));
        }
    }

}