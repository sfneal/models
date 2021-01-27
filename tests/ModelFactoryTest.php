<?php

namespace Sfneal\Builders\Tests;

class ModelFactoryTest extends TestCase
{
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
