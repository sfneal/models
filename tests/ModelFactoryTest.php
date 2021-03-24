<?php

namespace Sfneal\Models\Tests;

class ModelFactoryTest extends TestCase
{
    /** @test */
    public function fillables_are_correct_types()
    {
        $this->assertIsString($this->peopleModel->name_first);
        $this->assertIsString($this->peopleModel->name_last);
        $this->assertStringContainsString('@', $this->peopleModel->email);
        $this->assertIsInt($this->peopleModel->age);
        $this->assertIsString($this->peopleModel->address);
        $this->assertIsString($this->peopleModel->city);
        $this->assertIsString($this->peopleModel->state);
        $this->assertIsString($this->peopleModel->zip);
    }

    /** @test */
    public function attributes_are_correct_types()
    {
        // Name attributes
        $this->assertIsString($this->peopleModel->name_full);
        $this->assertStringContainsString(', ', $this->peopleModel->name_last_first);
        $this->assertStringContainsString($this->peopleModel->name_first, $this->peopleModel->name_full);
        $this->assertStringContainsString($this->peopleModel->name_last, $this->peopleModel->name_full);

        // Address attributes
        $this->assertIsString($this->peopleModel->address_full);
        $this->assertStringContainsString(', ', $this->peopleModel->address_full);
        $this->assertStringContainsString($this->peopleModel->address, $this->peopleModel->address_full);
        $this->assertStringContainsString($this->peopleModel->city, $this->peopleModel->address_full);
        $this->assertStringContainsString($this->peopleModel->state, $this->peopleModel->address_full);
        $this->assertStringContainsString($this->peopleModel->zip, $this->peopleModel->address_full);
    }
}
