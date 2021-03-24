<?php

namespace Sfneal\Models\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Models\Tests\Models\People;

class TestCase extends OrchestraTestCase
{
    /**
     * @var People
     */
    public $peopleModel;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->peopleModel = People::factory()->make();
    }
}
