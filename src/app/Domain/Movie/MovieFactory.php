<?php

declare(strict_types=1);

namespace App\Domain\Movie;

class MovieFactory
{
    public function create(string $title): MovieInterface
    {
        return new Movie($title);
    }
}