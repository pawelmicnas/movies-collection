<?php

declare(strict_types=1);

namespace Infrastructure\Movie\SearchEngine\InMemory;

use App\Infrastructure\Movie\SearchEngine\InMemory\FindRandom;
use App\Infrastructure\Source\Static\MoviesCollection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindRandomTest extends TestCase
{
    private MoviesCollection|MockObject $moviesCollectionMock;
    private FindRandom $find;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->moviesCollectionMock = $this->createMock(MoviesCollection::class);

        $this->find = new FindRandom($this->moviesCollectionMock);
    }

    #[DataProvider('dataProviderForTestFindRandom')]
    public function testFindRandom(int $limit, array $dataset): void
    {
        $this->moviesCollectionMock->method('all')->willReturn($dataset);
        $result = $this->find->execute($limit);

        $this->assertCount($limit, $result);
    }

    public static function dataProviderForTestFindRandom(): array
    {
        return [
            'Test given limit 1, then assert result has one title' => [1, ['Movie1', 'Movie2']],
            'Test given limit 0, then assert result is empty' => [0, ['Movie1', 'Movie2']],
            'Test given limit 2, then assert result has two titles' => [2, ['Movie1', 'Movie2']],
        ];
    }
}