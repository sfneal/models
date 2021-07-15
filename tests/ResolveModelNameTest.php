<?php

namespace Sfneal\Models\Tests;

use Sfneal\Models\Actions\ResolveModelName;
use Sfneal\Models\Tests\Assets\Models\CompanyPeople;
use Sfneal\Models\Tests\Assets\Models\People;

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
