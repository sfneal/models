<?php

namespace Sfneal\Models\Tests\Feature\Builders;

use Sfneal\Builders\QueryBuilder;
use Sfneal\Models\Tests\Assets\Builders\PeopleBuilder;
use Sfneal\Models\Tests\Assets\Models\People;
use Sfneal\Models\Tests\SeededTestCase;

class WhereBetweenSplitterTest extends SeededTestCase
{
    /**
     * @return array
     */
    public function ageRangeProvider(): array
    {
        $ranges = [
            [rand(21, 70), rand(21, 70)],
            [rand(21, 70), rand(21, 70)],
            [rand(21, 70), rand(21, 70)],
            [rand(21, 70), rand(21, 70)],
            [rand(21, 70), rand(21, 70)],
        ];

        $data = [];
        foreach ($ranges as $range) {
            $min = min($range);
            $max = max($range);
            $data[] = [$min, $max, [$min, $max]];
            $data[] = [$min, $max, "{$min}-{$max}"];
        }

        return $data;
    }

    /**
     * @test
     *
     * @dataProvider ageRangeProvider
     */
    public function whereBetweenSplitter(int $min, int $max, $range)
    {
        $query = People::query()->whereBetweenSplitter('age', $range);

        $this->assertTrue($query instanceof QueryBuilder);
        $this->assertTrue($query instanceof PeopleBuilder);
        $query->pluck('age')->each(function (int $age) use ($min, $max) {
            $this->assertGreaterThanOrEqual($min, $age);
            $this->assertLessThanOrEqual($max, $age);
        });
    }
}
