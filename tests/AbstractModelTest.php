<?php


namespace Sfneal\Models\Tests;


class AbstractModelTest extends TestCase
{
    /** @test */
    public function getLabel()
    {
        $label = $this->model->getLabel();
        $this->assertIsInt($label);
    }

    /** @test */
    public function hasAttribute()
    {
        $this->assertTrue($this->model->hasAttribute('name_first', true));
        $this->assertTrue($this->model->hasAttribute('address', true));
        $this->assertTrue($this->model->hasAttribute('name_full', false));
        $this->assertTrue($this->model->hasAttribute('address_full', false));
    }
}
