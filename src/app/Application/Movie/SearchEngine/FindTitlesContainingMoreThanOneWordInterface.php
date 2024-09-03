<?php

declare(strict_types=1);

namespace App\Application\Movie\SearchEngine;

interface FindTitlesContainingMoreThanOneWordInterface
{
    /**
     * @return string[]
     */
    public function execute(): array;
}