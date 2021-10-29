<?php

namespace App\Domain\Post;

use App\Domain\Author\Author;
use App\Shared\Arrayable;

class Post implements Arrayable
{
    private PostId $id;
    private Author $author;
    private PostTitle $title;
    private PostContent $content;

    public function __construct(PostId $id, Author $author, PostTitle $title, PostContent $content)
    {
        $this->id = $id;
        $this->author = $author;
        $this->title = $title;
        $this->content = $content;
    }

    public function getId(): PostId
    {
        return $this->id;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getTitle(): PostTitle
    {
        return $this->title;
    }

    public function getContent(): PostContent
    {
        return $this->content;
    }

    public function asArray(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            'title' => $this->getTitle()->getValue(),
            'content' => $this->getContent()->getValue(),
            'author' => $this->getAuthor()->asArray()
        ];
    }
}
