<?php

namespace Sfneal\Models\Tests;

class AbstractModelTest extends TestCase
{
    // todo: improve test methods

    /** @test */
    public function hasAttribute()
    {
        $this->assertTrue($this->peopleModel->hasAttribute('name_first', true));
        $this->assertTrue($this->peopleModel->hasAttribute('address', true));
        $this->assertTrue($this->peopleModel->hasAttribute('name_full', false));
        $this->assertTrue($this->peopleModel->hasAttribute('address_full', false));
        $this->assertFalse($this->peopleModel->hasAttribute('first_name', true));
        $this->assertFalse($this->peopleModel->hasAttribute('address_latest', true));
        $this->assertFalse($this->peopleModel->hasAttribute('name_full_with_suffix', false));
        $this->assertFalse($this->peopleModel->hasAttribute('address_city', false));
    }

    /** @test */
    public function getLabel()
    {
        $label = $this->peopleModel->getLabel();
        $this->assertIsInt($label);
    }

    /** @test */
    public function idHash()
    {
        $this->assertIsInt($this->peopleModel->id_hash);
    }

    /** @test */
    public function getTableName()
    {
        $tableName = $this->peopleModel->getTableName();
        $this->assertIsString($tableName);
        $this->assertTrue($tableName == 'people');
    }

    /** @test */
    public function getPrimaryKeyName()
    {
        $primaryKey = $this->peopleModel->getPrimaryKeyName();
        $this->assertIsString($primaryKey);
        $this->assertTrue($primaryKey == 'person_id');
    }

    /** @test */
    public function getUploadDirectory()
    {
        $uploadDirectory = $this->peopleModel->getUploadDirectory();
        $this->assertIsString($uploadDirectory);
        $this->assertTrue($uploadDirectory == "files/{$this->peopleModel->getTableName()}/{$this->peopleModel->getKey()}");
    }
}
