<?php

namespace Sfneal\Models\Tests;

use Sfneal\Models\Tests\Models\People;

class ModelTestCase extends TestCase
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
