<?php

declare(strict_types=1);

namespace App\Application\Query\Movie;

use App\Domain\Bus\Query\QueryInterface;

class GetRandomMovies implements QueryInterface
{
    public function __construct(
        public readonly int $limit
    ) {
    }
}