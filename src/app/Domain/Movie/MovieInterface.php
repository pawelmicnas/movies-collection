<?php

declare(strict_types=1);

namespace App\Domain\Movie;

interface MovieInterface
{
    public function title(): string;
}