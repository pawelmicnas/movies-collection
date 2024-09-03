<?php

declare(strict_types=1);

namespace App\Infrastructure\Movie\SearchEngine\InMemory;

use App\Application\Movie\SearchEngine\FindRandomInterface;
use App\Infrastructure\Source\Static\MoviesCollection;

class FindRandom implements FindRandomInterface
{
    public function __construct(
        private readonly MoviesCollection $moviesCollection,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function execute(int $limit): array
    {
        if ($limit < 1) {
            return [];
        }

        $data = $this->moviesCollection->all();
        $rand = array_rand($data, $limit);

        return array_filter($data, function ($key) use ($rand) {
            return is_array($rand) ? in_array($key, $rand) : $key === $rand;
        }, ARRAY_FILTER_USE_KEY);
    }
}