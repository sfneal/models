<?php

namespace Sfneal\Models\Tests\Feature\Builders;

use Sfneal\Builders\QueryBuilder;
use Sfneal\Helpers\Arrays\ArrayHelpers;
use Sfneal\Models\Tests\Assets\Builders\PeopleBuilder;
use Sfneal\Models\Tests\Assets\Models\People;
use Sfneal\Models\Tests\SeededTestCase;

class WherePublicStatusTest extends SeededTestCase
{
    /**
     * @param $query
     * @param $value
     */
    private function executeAssertions($query, $value): void
    {
        $this->assertTrue($query instanceof QueryBuilder);
        $this->assertTrue($query instanceof PeopleBuilder);

        $this->assertTrue(
            ArrayHelpers::from($query->pluck('public_status')->toArray())->valuesEqual($value)
        );
    }

    /** @test */
    public function wherePublic()
    {
        $this->executeAssertions(People::query()->wherePublic(), 1);
    }

    /** @test */
    public function wherePrivate()
    {
        $this->executeAssertions(People::query()->wherePrivate(), 0);
    }
}
