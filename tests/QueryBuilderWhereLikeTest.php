<?php

namespace Sfneal\Models\Tests;

use Sfneal\Builders\QueryBuilder;
use Sfneal\Models\Tests\Assets\Models\People;

class QueryBuilderWhereLikeTest extends BuilderTestCase
{
    private function whereLikeAssertions(QueryBuilder $query)
    {
        $this->assertTrue($query instanceof QueryBuilder);
        $this->assertSame($query->count(), 2);
        $this->assertTrue(in_array('Stephen', $query->getFlatArray('name_first')));
        $this->assertTrue(in_array('Richard', $query->getFlatArray('name_first')));
    }

    /** @test */
    public function whereLike()
    {
        // Basic usage
        $query = People::query()->whereLike('name_last', 'Neal');
        $this->whereLikeAssertions($query);

        // Leading wildcard usage
        $query2 = People::query()->whereLike('address', 'Ice House Lane', true, false);
        $this->whereLikeAssertions($query2);

        // Trailing wildcard usage
        $query3 = People::query()->whereLike('city', 'Frank', false, true);
        $this->whereLikeAssertions($query3);
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
