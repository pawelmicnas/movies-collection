<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus\Query;

use App\Domain\Bus\Query\QueryBusInterface;
use App\Domain\Bus\Query\QueryInterface;
use App\Domain\Bus\Query\ResultInterface;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;

class BasicQueryBus implements QueryBusInterface
{
    use HandleTrait;

    /**
     * @param callable[][] $handlers
     */
    public function __construct(array $handlers) {
        $this->messageBus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator($handlers)),
        ]);
    }

    public function ask(QueryInterface $query): ?ResultInterface
    {
        return $this->handle($query);
    }
}