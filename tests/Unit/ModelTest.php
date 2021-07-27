<?php

namespace Sfneal\Models\Tests\Unit;

use Sfneal\Models\Tests\ModelTestCase;

class ModelTest extends ModelTestCase
{
    // todo: improve test methods

    /** @test */
    public function hasAttribute()
    {
        $this->assertTrue($this->model->hasAttribute('name_first', true));
        $this->assertTrue($this->model->hasAttribute('name_last', true));
        $this->assertTrue($this->model->hasAttribute('email', true));
        $this->assertTrue($this->model->hasAttribute('age', true));
        $this->assertTrue($this->model->hasAttribute('address', true));
        $this->assertTrue($this->model->hasAttribute('city', true));
        $this->assertTrue($this->model->hasAttribute('state', true));
        $this->assertTrue($this->model->hasAttribute('zip', true));
        $this->assertTrue($this->model->hasAttribute('public_status', true));

        $this->assertFalse($this->model->hasAttribute('name_full', false));
        $this->assertFalse($this->model->hasAttribute('name_last_first', false));
        $this->assertFalse($this->model->hasAttribute('address_full', false));
        $this->assertFalse($this->model->hasAttribute('address_latest', false));
        $this->assertFalse($this->model->hasAttribute('name_full_with_suffix', false));
        $this->assertFalse($this->model->hasAttribute('address_city', false));
    }

    /** @test */
    public function isNew()
    {
        $this->assertTrue($this->model->isNew());
    }

    /** @test */
    public function getLabel()
    {
        $label = $this->model->getLabel();
        $this->assertSame($label, $this->model->getKey());
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
