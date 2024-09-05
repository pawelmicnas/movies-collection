<?php

declare(strict_types=1);

namespace Infrastructure\Movie\SearchEngine\InMemory;

use App\Infrastructure\Movie\SearchEngine\InMemory\FindTitlesContainingMoreThanOneWord;
use App\Infrastructure\Source\Static\MoviesCollection;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FindTitlesContainingMoreThanOneWordTest extends TestCase
{
    private MoviesCollection|MockObject $moviesCollectionMock;
    private FindTitlesContainingMoreThanOneWord $find;

    protected function setUp(): void
    {
        $this->moviesCollectionMock = $this->createMock(MoviesCollection::class);

        $this->find = new FindTitlesContainingMoreThanOneWord($this->moviesCollectionMock);
    }

    #[DataProvider('dataProviderForTestFind')]
    public function testFind(array $dataset, array $expected): void
    {
        $this->moviesCollectionMock->method('all')->willReturn($dataset);

        $this->assertSame($expected, $this->find->execute());
    }

    public static function dataProviderForTestFind(): array
    {
        return [
            'Test given data set only with one-word titles, then assert result is empty' => [['Titanic', 'Moana', 'Shrek'], []],
            'Test given data set with one title with more than 1 word, then assert it is in the result' => [['Pan i Władca na Krańcu Świata', 'Shrek'], ['Pan i Władca na Krańcu Świata']],
        ];
    }
}