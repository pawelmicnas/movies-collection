<?php

declare(strict_types=1);

namespace App\UserInterface\Cli;

use App\Application\Movie\MovieReadModel;
use App\Application\Movie\MovieResult;
use App\Application\Query\Movie\GetMoviesWithEvenNumberOfSignsInTitleByFirstLetter;
use App\Application\Query\Movie\GetMoviesWithTitleContainingMoreThanOneWord;
use App\Application\Query\Movie\GetRandomMovies;
use App\Domain\Bus\Query\QueryBusInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: "demo:demo",
    description: "Present 3 different queries available in the system"
)]
class Demo extends Command
{
    public function __construct(
        private readonly QueryBusInterface $queryBus,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title("Demo - Execution of query with titles containing more than one word");
        $this->drawTable($io, $this->queryBus->ask(new GetMoviesWithTitleContainingMoreThanOneWord()));

        $io->title("Demo - Execution of query with random titles.");
        $limit = $io->askQuestion(new Question('Provide limit for number of random titles: '));
        $this->drawTable($io, $this->queryBus->ask(new GetRandomMovies((int)$limit)));

        $io->title("Demo - Execution of query with titles with even number of signs and by first letter");
        $letter = $io->askQuestion(new Question('Provide first letter: '));
        $this->drawTable($io, $this->queryBus->ask(new GetMoviesWithEvenNumberOfSignsInTitleByFirstLetter($letter)));

        return 0;
    }

    private function drawTable(SymfonyStyle $io, MovieResult $result): void
    {
        $io->table(['title'], array_map(fn(MovieReadModel $movieReadModel) => [$movieReadModel->getTitle()], $result->get()));
    }
}