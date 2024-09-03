<?php

declare(strict_types=1);

namespace App\Infrastructure\Bus\Query;

use App\Domain\Bus\Query\QueryBusInterface;
use App\Domain\Bus\Query\QueryInterface;
use App\Domain\Bus\Query\ResultInterface;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class BasicQueryBus implements QueryBusInterface
{
    private MessageBus $bus;

    /**
     * @param callable[][] $handlers
     */
    public function __construct(array $handlers) {
        $this->bus = new MessageBus([
            new HandleMessageMiddleware(new HandlersLocator($handlers)),
        ]);
    }

    public function ask(QueryInterface $query): ?ResultInterface
    {
//        try {
            $handledStamp = $this->bus->dispatch($query)->last(HandledStamp::class);
            return $handledStamp->getResult();
//        } catch (HandlerFailedException) {
//            throw new BusGeneralException();
//        }
    }
}