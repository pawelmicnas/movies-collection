<?php

declare(strict_types=1);

namespace App\Infrastructure\Movie\SearchEngine\InMemory;

use App\Application\Movie\SearchEngine\FindTitlesWithEvenNumberOfSignsAndByFirstLetterInterface;
use App\Infrastructure\Source\Static\MoviesCollection;

class FindTitlesWithEvenNumberOfSignsAndByFirstLetter implements FindTitlesWithEvenNumberOfSignsAndByFirstLetterInterface
{
    public function __construct(
        private readonly MoviesCollection $moviesCollection,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(string $firstLetter): array
    {
        $data = $this->moviesCollection->all();

        return array_filter($data, function ($title) use ($firstLetter) {
            return mb_strlen($title) % 2 === 0 && mb_substr($title, 0, 1) === strtoupper($firstLetter);
        });
    }
}