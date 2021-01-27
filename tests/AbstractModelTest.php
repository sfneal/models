<?php

namespace Sfneal\Models\Tests;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Sfneal\Models\Tests\Models\People;

class AbstractModelTest extends OrchestraTestCase
{
    /**
     * @var Collection|Model|mixed
     */
    private $model;

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

    /** @test */
    public function fillables_are_correct_types()
    {
        $this->assertIsString($this->model->name_first);
        $this->assertIsString($this->model->name_last);
        $this->assertStringContainsString('@', $this->model->email);
        $this->assertIsInt($this->model->age);
        $this->assertIsString($this->model->address);
        $this->assertIsString($this->model->city);
        $this->assertIsString($this->model->state);
        $this->assertIsString($this->model->zip);
    }

    /** @test */
    public function attributes_are_correct_types()
    {
        // Name attributes
        $this->assertIsString($this->model->name_full);
        $this->assertStringContainsString(', ', $this->model->name_last_first);
        $this->assertStringContainsString($this->model->name_first, $this->model->name_full);
        $this->assertStringContainsString($this->model->name_last, $this->model->name_full);

        // Address attributes
        $this->assertIsString($this->model->address_full);
        $this->assertStringContainsString(', ', $this->model->address_full);
        $this->assertStringContainsString($this->model->address, $this->model->address_full);
        $this->assertStringContainsString($this->model->city, $this->model->address_full);
        $this->assertStringContainsString($this->model->state, $this->model->address_full);
        $this->assertStringContainsString($this->model->zip, $this->model->address_full);
    }
}
