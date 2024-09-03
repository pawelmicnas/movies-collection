<?php

declare(strict_types=1);

namespace App\Application\Query\Movie;

use App\Application\Adapter\MovieModelToReadModel;
use App\Application\Movie\SearchEngine\FindRandomInterface;
use App\Domain\Bus\Query\ResultInterface;
use App\Domain\Movie\MovieFactory;

class GetRandomMoviesHandler extends AbstractQueryMovieHandler
{
    public function __construct(
        private readonly FindRandomInterface $find,
        MovieFactory $movieFactory,
        MovieModelToReadModel $adapter,
    ) {
        parent::__construct($movieFactory, $adapter);
    }


    public function __invoke(GetRandomMovies $query): ResultInterface
    {
        return $this->generateMovieResult($this->find->execute($query->limit));
    }
}