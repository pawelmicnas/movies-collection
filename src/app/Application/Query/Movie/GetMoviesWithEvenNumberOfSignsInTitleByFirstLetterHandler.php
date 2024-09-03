<?php

declare(strict_types=1);

namespace App\Application\Query\Movie;

use App\Application\Adapter\MovieModelToReadModel;
use App\Application\Movie\SearchEngine\FindTitlesWithEvenNumberOfSignsAndByFirstLetterInterface;
use App\Domain\Bus\Query\ResultInterface;
use App\Domain\Movie\MovieFactory;

class GetMoviesWithEvenNumberOfSignsInTitleByFirstLetterHandler extends AbstractQueryMovieHandler
{
    public function __construct(
        private readonly FindTitlesWithEvenNumberOfSignsAndByFirstLetterInterface $find,
        MovieFactory $movieFactory,
        MovieModelToReadModel $adapter,
    ) {
        parent::__construct($movieFactory, $adapter);
    }

    public function __invoke(GetMoviesWithEvenNumberOfSignsInTitleByFirstLetter $query): ResultInterface
    {
        return $this->generateMovieResult($this->find->execute($query->firstLetter));
    }
}