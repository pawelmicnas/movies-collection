<?php

declare(strict_types=1);

namespace App\Application\Movie;

use App\Domain\Bus\Query\ReadModelInterface;

class MovieReadModelCollection implements ReadModelInterface
{
    /**
     * @param MovieReadModel[] $movies
     */
    public function __construct(
        private readonly array $movies
    ) {
    }

    public function all(): array
    {
        return $this->movies;
    }
}