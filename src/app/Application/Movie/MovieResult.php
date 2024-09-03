<?php

declare(strict_types=1);

namespace App\Application\Movie;

use App\Domain\Bus\Query\ResultInterface;

class MovieResult implements ResultInterface
{
    public function __construct(
        private readonly MovieReadModelCollection $collection,
    ) {
    }

    public function get(): mixed
    {
        return $this->collection->all();
    }
}