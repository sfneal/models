<?php

namespace Sfneal\Models\Tests\Feature;

use Exception;
use Sfneal\Models\Tests\Assets\Models\People;
use Sfneal\Models\Tests\BuilderTestCase;

class QueryBuilderTest extends BuilderTestCase
{
    /** @test */
    public function getFlatArray()
    {
        $query = People::query();
        $array = $query->getFlatArray('city');

        $this->assertIsArray($array);
        foreach ($array as $item) {
            $this->assertIsString($item);
        }
        $this->assertSame($query->count('city'), count($array));
    }

    /** @test */
    public function selectRawJson()
    {
        $results = People::query()
            ->selectRawJson('people.person_id as id, people.name_last as text')
            ->countAndPaginate();

        $this->assertSame($results['total_count'], 22);
    }

    /** @test */
    public function orderByCreatedAt()
    {
        $output = People::query()->orderByCreatedAt('desc')->get()->toArray();
        $expected = People::query()->orderBy('created_at', 'desc')->get()->toArray();

        $this->assertIsArray($output);
        $this->assertIsArray($expected);
        $this->assertSame($output, $expected);
    }

    /**
     * @test
     * @throws Exception
     */
    public function getNextModel()
    {
        // Prevent randomly selecting the last item which has no 'next' model
        $id = random_int(
            People::query()->first()->getKey(),
            People::query()->orderBy('person_id', 'desc')->first()->getKey() - 1
        );
        $model = People::query()->find($id);
        $nextModel = $model->getNextModel();

        $this->assertSame($nextModel->person_id - 1, $model->person_id);
    }

    /**
     * @test
     * @throws Exception
     */
    public function getPreviousModel()
    {
        // Prevent randomly selecting the first model that doesn't have a 'previous' model
        $id = random_int(
            People::query()->first()->getKey() + 1,
            People::query()->orderBy('person_id', 'desc')->first()->getKey()
        );
        $model = People::query()->find($id);
        $nextModel = $model->getPreviousModel();

        $this->assertSame($nextModel->person_id + 1, $model->person_id);
    }
}
