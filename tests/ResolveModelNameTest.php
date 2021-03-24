<?php


namespace Sfneal\Models\Tests;


use Sfneal\Models\Actions\ResolveModelName;
use Sfneal\Models\Tests\Models\CompanyPeople;

class ResolveModelNameTest extends TestCase
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
    public function resolveCompanyPeopleModelName()
    {
        $model = CompanyPeople::factory()->make();
        $expected = 'Company People';
        $output = (new ResolveModelName($model, true))->execute();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }
}
