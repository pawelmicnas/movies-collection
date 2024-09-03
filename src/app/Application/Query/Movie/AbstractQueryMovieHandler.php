<?php

declare(strict_types=1);

namespace App\Application\Query\Movie;

use App\Application\Adapter\MovieModelToReadModel;
use App\Application\Movie\MovieReadModelCollection;
use App\Application\Movie\MovieResult;
use App\Domain\Movie\MovieFactory;

abstract class AbstractQueryMovieHandler
{
    public function __construct(
        private readonly MovieFactory $movieFactory,
        private readonly MovieModelToReadModel $adapter,
    ) {
    }

    protected function generateMovieResult(array $titles): MovieResult
    {
        $movies = [];
        foreach ($titles as $title) {
            $movies[] = $this->adapter->adapt($this->movieFactory->create($title));
        }

        return new MovieResult(
            new MovieReadModelCollection($movies)
        );
    }
}