<?php

namespace App\Domain\Author;

use App\Domain\Author\Address\Address;
use App\Domain\Author\Company\Company;
use App\Shared\Arrayable;

class Author implements Arrayable
{
    private AuthorId $id;
    private ?AuthorName $name;
    private ?AuthorUsername $username;
    private ?AuthorEmail $email;
    private ?Address $address;
    private ?AuthorPhone $phone;
    private ?AuthorWebsite $website;
    private ?Company $company;

    public function __construct(
        AuthorId $id,
        ?AuthorName $name,
        ?AuthorUsername $username,
        ?AuthorEmail $email,
        ?Address $address,
        ?AuthorPhone $phone,
        ?AuthorWebsite $website,
        ?Company $company
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
        $this->website = $website;
        $this->company = $company;
    }

    public function getId(): AuthorId
    {
        return $this->id;
    }

    public function getName(): ?AuthorName
    {
        return $this->name;
    }

    public function getUsername(): ?AuthorUsername
    {
        return $this->username;
    }

    public function getEmail(): ?AuthorEmail
    {
        return $this->email;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getPhone(): ?AuthorPhone
    {
        return $this->phone;
    }

    public function getWebsite(): ?AuthorWebsite
    {
        return $this->website;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function asArray(): array
    {
        $asArray = [
            'id' => $this->getId()->getValue(),
            'name' => is_null($this->getName()) ? null : $this->getName()->getValue(),
            'username' => is_null($this->getUsername()) ? null : $this->getUsername()->getValue(),
            'email' => is_null($this->getEmail()) ? null : $this->getEmail()->getValue(),
            'address' => is_null($this->getAddress()) ? null : $this->getAddress()->asArray(),
            'phone' => is_null($this->getPhone()) ? null : $this->getPhone()->getValue(),
            'website' => is_null($this->getWebsite()) ? null : $this->getWebsite()->getValue(),
            'company' => is_null($this->getCompany()) ? null : $this->getCompany()->asArray()
        ];

        foreach ($asArray as $field => $value) {
            if (is_null($value)) {
                unset($asArray[$field]);
            }
        }

        return $asArray;
    }

    public static function createEmpty(AuthorId $id): self
    {
        return new self(
            $id,
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
    }
}
