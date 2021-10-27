<?php

namespace App\Infrastructure\Persistence\Author;

use App\Domain\Author\Author;
use App\Domain\Author\AuthorEmail;
use App\Domain\Author\AuthorId;
use App\Domain\Author\AuthorName;
use App\Domain\Author\AuthorPhone;
use App\Domain\Author\AuthorUsername;
use App\Domain\Author\AuthorWebsite;

class JSONPlaceholderAuthorParser
{
    private JSONPlaceholderAuthorCompanyParser $companyParser;
    private JSONPlaceholderAuthorAddressParser $addressParser;

    public function __construct(
        JSONPlaceholderAuthorCompanyParser $companyParser,
        JSONPlaceholderAuthorAddressParser $addressParser
    ) {
        $this->companyParser = $companyParser;
        $this->addressParser = $addressParser;
    }

    public function toDomain(array $jsonPlaceholderUser): Author
    {
        $authorId = new AuthorId($jsonPlaceholderUser['id']);
        $name = new AuthorName($jsonPlaceholderUser['name']);
        $username = new AuthorUsername($jsonPlaceholderUser['username']);
        $email = new AuthorEmail($jsonPlaceholderUser['email']);
        $address = $this->addressParser->toDomain($jsonPlaceholderUser['address']);
        $phone = new AuthorPhone($jsonPlaceholderUser['phone']);
        $website = new AuthorWebsite($jsonPlaceholderUser['website']);
        $company = $this->companyParser->toDomain($jsonPlaceholderUser['company']);

        return new Author(
            $authorId,
            $name,
            $username,
            $email,
            $address,
            $phone,
            $website,
            $company
        );
    }
}