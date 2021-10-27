<?php

namespace App\Domain\Post\Errors;

use App\Domain\Post\PostId;
use App\Domain\Shared\DomainError;

class PostNotExists extends DomainError
{
    private PostId $postId;

    public function __construct(PostId $postId)
    {
        $this->postId = $postId;
        parent::__construct();
    }

    protected function errorMessage(): string
    {
        return "The post {$this->postId->getValue()} does not exist";
    }
}
