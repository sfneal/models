<?php

namespace Sfneal\Models\Tests;

use Illuminate\Support\Collection;
use Sfneal\Models\Tests\Assets\Models\People;

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

        $this->model = People::factory()->create();
    }

    protected function resolvePhpUnitAnnotations(): Collection
    {
        return collect();
    }
}
