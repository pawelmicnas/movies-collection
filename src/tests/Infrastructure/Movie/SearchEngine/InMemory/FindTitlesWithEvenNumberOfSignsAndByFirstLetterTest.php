<?php

declare(strict_types=1);

namespace Infrastructure\Movie\SearchEngine\InMemory;

use App\Infrastructure\Movie\SearchEngine\InMemory\FindTitlesWithEvenNumberOfSignsAndByFirstLetter;
use App\Infrastructure\Source\Static\MoviesCollection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindTitlesWithEvenNumberOfSignsAndByFirstLetterTest extends TestCase
{
    private MoviesCollection|MockObject $moviesCollectionMock;
    private FindTitlesWithEvenNumberOfSignsAndByFirstLetter $find;

    protected function setUp(): void
    {
        $this->moviesCollectionMock = $this->createMock(MoviesCollection::class);

        $this->find = new FindTitlesWithEvenNumberOfSignsAndByFirstLetter($this->moviesCollectionMock);
    }

    #[DataProvider('dataProviderForTestFind')]
    public function testFind(string $firstLetter, array $dataset, array $expected): void
    {
        $this->moviesCollectionMock->method('all')->willReturn($dataset);

        $this->assertSame($expected, $this->find->execute($firstLetter));
    }

    public static function dataProviderForTestFind(): array
    {
        return [
            'Test given first letter W and data set with two movies on W, then assert only movie with even number of letters is returned' => ['W', ['Whiplash', 'Władca much'], ['Whiplash']],
            'Test given first letter Q and data set without titles starting with that letter, then assert empty result is returned' => ['Q', ['Whiplash', 'Władca much'], []],
        ];
    }
}