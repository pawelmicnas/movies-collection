<?php

declare(strict_types=1);

namespace App\UserInterface\Web\Controller\Movies;

use App\Application\Query\Movie\GetRandomMovies;
use App\Domain\Bus\Exception\BusGeneralException;
use App\Domain\Bus\Query\QueryBusInterface;
use App\Infrastructure\Serializer\SerializerFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

class GetRandom
{
    #[Route('/movies/random', methods: ['GET'])]
    #[Cache(maxage: 300, public: true, mustRevalidate: true)]
    public function __invoke(Request $request, QueryBusInterface $bus, SerializerFactory $serializerFactory): Response
    {
        try {
            $result = $bus->ask(new GetRandomMovies((int)$request->get('limit')));
        } catch (BusGeneralException) {
            return new JsonResponse(['message' => 'Failed searching movies'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return new JsonResponse($serializerFactory->create()->serialize($result->get(), 'json'), json: true);
    }
}