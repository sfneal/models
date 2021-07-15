<?php

namespace Sfneal\Models\Tests\Feature;

use Sfneal\Models\Actions\ResolveModelName;
use Sfneal\Models\Tests\Assets\Models\CompanyPeople;
use Sfneal\Models\Tests\Assets\Models\People;
use Sfneal\Models\Tests\ModelTestCase;

class ResolveModelNameTest extends ModelTestCase
{
    /** @test */
    public function resolvePeopleModelName()
    {
        $expected = 'People';
        $output = (new ResolveModelName($this->model, true))->execute();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function resolveClassModelName()
    {
        $expected = 'People';
        $output = (new ResolveModelName(People::class, true))->execute();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    /** @test */
    public function resolveCompanyPeopleModelName()
    {
        $model = CompanyPeople::factory()->make();
        $expected = 'Company People';
        $output = (new ResolveModelName($model, true))->execute();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }
}
