<?php

namespace Sfneal\Builders\Tests;

use Sfneal\Builders\QueryBuilder;
use Sfneal\Builders\Tests\Models\People;

class QueryBuilderTest extends TestCase
{
    private function whereLikeAssertions (QueryBuilder $query)
    {
        $this->assertTrue($query instanceof QueryBuilder);
        $this->assertSame($query->count(), 2);
        $this->assertTrue(in_array('Stephen', $query->getFlatArray('name_first')));
        $this->assertTrue(in_array('Richard', $query->getFlatArray('name_first')));
    }

    /** @test */
    public function whereLike()
    {
        $query = People::query()->whereLike('name_last', 'Neal');

        $this->whereLikeAssertions($query);
    }

    /** @test */
    public function orWhereLike()
    {
        $query = People::query()
            ->orWhereLike('name_first', 'Stephen')
            ->orWhereLike('name_first', 'Richard');

        $this->whereLikeAssertions($query);
    }
}
