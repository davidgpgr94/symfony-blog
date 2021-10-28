<?php

namespace App\Tests\Domain\Author;

use App\Domain\Author\Address\Address;
use App\Domain\Author\Address\AddressCity;
use App\Domain\Author\Address\AddressGeolocation;
use App\Domain\Author\Address\AddressStreet;
use App\Domain\Author\Address\AddressSuite;
use App\Domain\Author\Address\AddressZipcode;
use App\Domain\Author\Address\Latitude;
use App\Domain\Author\Address\Longitude;
use App\Domain\Author\Author;
use App\Domain\Author\AuthorEmail;
use App\Domain\Author\AuthorId;
use App\Domain\Author\AuthorName;
use App\Domain\Author\AuthorPhone;
use App\Domain\Author\AuthorUsername;
use App\Domain\Author\AuthorWebsite;
use App\Domain\Author\Company\Company;
use App\Domain\Author\Company\CompanyCatchPhrase;
use App\Domain\Author\Company\CompanyName;
use PHPUnit\Framework\TestCase;

class AuthorUnitTest extends TestCase
{
    private Author $fullAuthor;
    private Author $authorWithOnlyId;

    private array $keysFullAuthorMustHaveAsArray = [
        'id', 'name', 'username', 'email', 'address', 'phone', 'website', 'company'
    ];

    /** @before */
    public function setUpValidAuthor()
    {
        $this->fullAuthor = new Author(
            new AuthorId(1),
            new AuthorName('Homer'),
            new AuthorUsername('Mr.X'),
            new AuthorEmail('homer@example.com'),
            new Address(
                new AddressStreet('Evergreen Terrace'),
                new AddressSuite('742'),
                new AddressCity('Springfield'),
                new AddressZipcode('65619'),
                new AddressGeolocation(
                    new Latitude('37.2138'),
                    new Longitude('-93.3044')
                )
            ),
            new AuthorPhone('1234567890'),
            new AuthorWebsite('mrx.example.com'),
            new Company(
                new CompanyName('Kwik-E-Markt'),
                new CompanyCatchPhrase('More than a badulaque')
            )
        );

        $this->authorWithOnlyId = new Author(
            new AuthorId(2),
            null,
            null,
            null,
            null,
            null,
            null,
            null
        );
    }


    /** @test */
    public function asArrayShouldReturnAllAuthorFields()
    {
        $fullAuthorAsArray = $this->fullAuthor->asArray();

        $this->assertIsArray($fullAuthorAsArray);

        foreach ($this->keysFullAuthorMustHaveAsArray as $keyFullAuthorMustHave) {
            $this->assertArrayHasKey($keyFullAuthorMustHave, $fullAuthorAsArray, "Missing key <{$keyFullAuthorMustHave}>");
        }
    }

    /** @test */
    public function asArrayShouldReturnOnlyTheAuthorId()
    {
        $authorWithOnlyIdAsArray = $this->authorWithOnlyId->asArray();

        $this->assertArrayHasKey('id', $authorWithOnlyIdAsArray, "Missing key <id>");
    }

    /** @test */
    public function asArrayShouldReturnKeysOfNotNullFields()
    {
        $author = new Author(
            new AuthorId(2),
            new AuthorName('Homer'),
            null,
            null,
            null,
            null,
            null,
            null
        );

        $authorKeys = array_keys($author->asArray());
        $this->assertEqualsCanonicalizing(['id', 'name'], $authorKeys);
    }

    /** @test */
    public function testCreateEmpty()
    {
        $emptyAuthor = Author::createEmpty(new AuthorId(3));

        $emptyAuthorKeys = array_keys($emptyAuthor->asArray());

        $this->assertEqualsCanonicalizing(['id'], $emptyAuthorKeys);
    }
}
