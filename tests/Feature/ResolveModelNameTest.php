<?php

namespace Sfneal\Models\Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Sfneal\Models\Actions\ResolveModelName;
use Sfneal\Models\Tests\Assets\Models\CompanyPeople;
use Sfneal\Models\Tests\Assets\Models\People;
use Sfneal\Models\Tests\ModelTestCase;

class ResolveModelNameTest extends ModelTestCase
{
    #[Test]
    public function resolvePeopleModelName()
    {
        $expected = 'People';
        $output = (new ResolveModelName($this->model, true))->execute();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    #[Test]
    public function resolveClassModelName()
    {
        $expected = 'People';
        $output = (new ResolveModelName(People::class, true))->execute();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }

    #[Test]
    public function resolveCompanyPeopleModelName()
    {
        $model = CompanyPeople::factory()->make();
        $expected = 'Company People';
        $output = (new ResolveModelName($model, true))->execute();

        $this->assertIsString($output);
        $this->assertEquals($expected, $output);
    }
}
