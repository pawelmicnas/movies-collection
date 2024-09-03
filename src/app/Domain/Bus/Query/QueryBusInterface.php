<?php

namespace App\Domain\Bus\Query;

use App\Domain\Bus\Exception\BusGeneralException;

interface QueryBusInterface
{
    /**
     * @throws BusGeneralException
     */
    public function ask(QueryInterface $query): ResultInterface|null;
}