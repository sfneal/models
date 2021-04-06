<?php

namespace Sfneal\Models\Tests;

class ModelTest extends TestCase
{
    // todo: improve test methods

    /** @test */
    public function hasAttribute()
    {
        $this->assertTrue($this->model->hasAttribute('name_first', true));
        $this->assertTrue($this->model->hasAttribute('address', true));
        $this->assertTrue($this->model->hasAttribute('name_full', false));
        $this->assertTrue($this->model->hasAttribute('address_full', false));
        $this->assertFalse($this->model->hasAttribute('first_name', true));
        $this->assertFalse($this->model->hasAttribute('address_latest', true));
        $this->assertFalse($this->model->hasAttribute('name_full_with_suffix', false));
        $this->assertFalse($this->model->hasAttribute('address_city', false));
    }

    /** @test */
    public function getLabel()
    {
        $label = $this->model->getLabel();
        $this->assertIsInt($label);
    }

    /** @test */
    public function idHash()
    {
        $this->assertIsInt($this->model->id_hash);
    }

    /** @test */
    public function getTableName()
    {
        $tableName = $this->model->getTableName();
        $this->assertIsString($tableName);
        $this->assertTrue($tableName == 'people');
    }

    /** @test */
    public function getPrimaryKeyName()
    {
        $primaryKey = $this->model->getPrimaryKeyName();
        $this->assertIsString($primaryKey);
        $this->assertTrue($primaryKey == 'person_id');
    }

    /** @test */
    public function getUploadDirectory()
    {
        $uploadDirectory = $this->model->getUploadDirectory();
        $this->assertIsString($uploadDirectory);
        $this->assertTrue($uploadDirectory == "files/{$this->model->getTableName()}/{$this->model->getKey()}");
    }
}
