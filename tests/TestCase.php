<?php

namespace Sfneal\Builders\Tests;

use Illuminate\Database\Eloquent\Collection;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Builders\Tests\Models\People;

class TestCase extends OrchestraTestCase
{
    /**
     * @var Collection
     */
    public $models;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->models = People::factory()->count(20)->make();
    }
}
