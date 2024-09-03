<?php

declare(strict_types=1);

namespace App\Application\Movie;

use App\Domain\Bus\Query\ReadModelInterface;

class MovieReadModel implements ReadModelInterface
{
    public function __construct(
       private readonly string $title,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}