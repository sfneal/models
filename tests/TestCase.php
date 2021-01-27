<?php

namespace Sfneal\Models\Tests;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Models\Tests\Models\People;

class TestCase extends OrchestraTestCase
{
    /**
     * @var Collection|Model|mixed
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
