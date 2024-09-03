<?php

declare(strict_types=1);

namespace App\Application\Movie\SearchEngine;

interface FindTitlesWithEvenNumberOfSignsAndByFirstLetterInterface
{
    /**
     * @return string[]
     */
    public function execute(string $firstLetter): array;
}