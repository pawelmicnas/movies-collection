<?php

declare(strict_types=1);

namespace App\Application\Adapter;

use App\Application\Movie\MovieReadModel;
use App\Domain\Movie\MovieInterface;

class MovieModelToReadModel
{
    public function adapt(MovieInterface $movie): MovieReadModel
    {
        return new MovieReadModel($movie->title());
    }
}