<?php

declare(strict_types=1);

namespace App\Infrastructure\Movie\SearchEngine\InMemory;

use App\Application\Movie\SearchEngine\FindTitlesContainingMoreThanOneWordInterface;
use App\Infrastructure\Source\Static\MoviesCollection;

class FindTitlesContainingMoreThanOneWord implements FindTitlesContainingMoreThanOneWordInterface
{
    public function __construct(
        private readonly MoviesCollection $moviesCollection,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(): array
    {
        $data = $this->moviesCollection->all();

        return array_filter($data, function ($title) {
            return str_word_count($title) > 1;
        });
    }
}