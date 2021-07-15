<?php

namespace Sfneal\Models\Tests\Feature\Builders;

use Sfneal\Builders\QueryBuilder;
use Sfneal\Models\Tests\Assets\Builders\PeopleBuilder;
use Sfneal\Models\Tests\Assets\Models\People;
use Sfneal\Models\Tests\BuilderTestCase;

class WhereLikeTest extends BuilderTestCase
{
    /**
     * @return array[]
     */
    public function queryParamProvider(): array
    {
        return [
            ['name_last', 'Neal', true, true],
            ['address', 'Ice House Lane', true, false],
            ['city', 'Frank', false, true],
        ];
    }

    /**
     * @param QueryBuilder $query
     */
    private function whereLikeAssertions(QueryBuilder $query)
    {
        $this->assertTrue($query instanceof QueryBuilder);
        $this->assertTrue($query instanceof PeopleBuilder);
        $this->assertSame($query->count(), 2);
        $this->assertTrue(in_array('Stephen', $query->getFlatArray('name_first')));
        $this->assertTrue(in_array('Richard', $query->getFlatArray('name_first')));
    }

    /**
     * @test
     * @dataProvider queryParamProvider
     * @param string $column
     * @param $value
     * @param bool $leadingWildcard
     * @param bool $trailingWildcard
     */
    public function whereLike(string $column, $value, bool $leadingWildcard = true, bool $trailingWildcard = true)
    {
        $query = People::query()->whereLike($column, $value, $leadingWildcard, $trailingWildcard);
        $this->whereLikeAssertions($query);
    }

    /** @test */
    public function orWhereLike()
    {
        // Basic usage
        $query = People::query()
            ->orWhereLike('name_first', 'Stephen')
            ->orWhereLike('name_first', 'Richard');
        $this->whereLikeAssertions($query);
    }
}
