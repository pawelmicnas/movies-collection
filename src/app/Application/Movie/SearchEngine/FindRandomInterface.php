<?php

declare(strict_types=1);

namespace App\Application\Movie\SearchEngine;

interface FindRandomInterface
{
    /**
     * @return string[]
     */
    public function execute(int $limit): array;
}