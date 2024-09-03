<?php

declare(strict_types=1);

namespace App\Domain\Movie;

class Movie implements MovieInterface
{
    public function __construct(
        private readonly string $title,
    ){}

    public function title(): string
    {
        return $this->title;
    }
}