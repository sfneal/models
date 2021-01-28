<?php

namespace Sfneal\Builders\Tests;

use Sfneal\Builders\Tests\Models\People;

class QueryBuilderTest extends TestCase
{
    /** @test */
    public function whereLike()
    {
        $query = People::query()->whereLike('name_last', 'Neal');

        $this->assertSame($query->count(), 2);
        $this->assertTrue(in_array('Stephen', $query->getFlatArray('name_first')));
        $this->assertTrue(in_array('Richard', $query->getFlatArray('name_first')));
    }
}
