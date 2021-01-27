<?php

namespace Sfneal\Models\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Models\Tests\Models\People;

class TestCase extends OrchestraTestCase
{
    /**
     * @var People
     */
    public $model;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->model = People::factory()->make();
    }
}
