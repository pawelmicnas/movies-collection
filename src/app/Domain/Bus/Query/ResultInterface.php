<?php

namespace App\Domain\Bus\Query;

interface ResultInterface
{
    public function get(): mixed;
}