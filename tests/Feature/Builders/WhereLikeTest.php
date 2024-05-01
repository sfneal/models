<?php

namespace Sfneal\Models\Tests\Feature\Builders;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Sfneal\Builders\QueryBuilder;
use Sfneal\Models\Tests\Assets\Builders\PeopleBuilder;
use Sfneal\Models\Tests\Assets\Models\People;
use Sfneal\Models\Tests\SeededTestCase;

class WhereLikeTest extends SeededTestCase
{
    /**
     * @return array[]
     */
    public static function queryParamProvider(): array
    {
        return [
            ['name_last', 'Neal', true, true],
            ['address', 'Ice House Lane', true, false],
            ['city', 'Frank', false, true],
        ];
    }

    /**
     * @param  QueryBuilder  $query
     */
    private function whereLikeAssertions(QueryBuilder $query)
    {
        $this->assertTrue($query instanceof PeopleBuilder);
//        $this->assertSame($query->count(), 2);
        $this->assertTrue(in_array('Stephen', $query->getFlatArray('name_first')));
        $this->assertTrue(in_array('Richard', $query->getFlatArray('name_first')));
    }

    #[Test]
    #[DataProvider('queryParamProvider')]
    public function whereLike(string $column, $value, bool $leadingWildcard = true, bool $trailingWildcard = true)
    {
        $query = People::query()->whereLike($column, $value, $leadingWildcard, $trailingWildcard);
        $this->whereLikeAssertions($query);
    }

    #[Test]
    public function orWhereLike()
    {
        // Basic usage
        $query = People::query()
            ->orWhereLike('name_first', 'Stephen')
            ->orWhereLike('name_first', 'Richard');
        $this->whereLikeAssertions($query);
    }

    #[Test]
    public function orWhereBool()
    {
        // Basic usage
        $query = People::query()
            ->whereLike('name_first', 'Stephen', true, true, 'or')
            ->whereLike('name_first', 'Richard', true, true, 'or');
        $this->whereLikeAssertions($query);
    }
}
