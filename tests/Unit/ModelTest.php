<?php

namespace Sfneal\Models\Tests\Unit;

use Sfneal\Models\Tests\ModelTestCase;

class ModelTest extends ModelTestCase
{
    // todo: improve test methods

    /** @test */
    public function isNew()
    {
        $this->assertTrue($this->model->isNew());
    }

    /** @test */
    public function howNew()
    {
        $this->assertIsFloat($this->model->howNew());
    }

    /** @test */
    public function getIsNewColumn()
    {
        $expected = 'created_at';
        $actual = $this->model->getIsNewColumn();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

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
    public function hasNullAttribute()
    {
        $this->assertFalse($this->model->hasNullAttribute('name_first'));
        $this->assertFalse($this->model->hasNullAttribute('name_last'));
        $this->assertFalse($this->model->hasNullAttribute('email'));
        $this->assertFalse($this->model->hasNullAttribute('age'));
        $this->assertFalse($this->model->hasNullAttribute('address'));
        $this->assertFalse($this->model->hasNullAttribute('city'));
        $this->assertFalse($this->model->hasNullAttribute('state'));
        $this->assertFalse($this->model->hasNullAttribute('zip'));
        $this->assertFalse($this->model->hasNullAttribute('public_status'));
    }

    /** @test */
    public function getIdHashAttribute()
    {
        $expected = crc32($this->model->getKey());
        $actual = $this->model->id_hash;

        $this->assertIsInt($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getIdHashAttribute());
    }

    /** @test */
    public function getLabel()
    {
        $label = $this->model->getLabel();
        $this->assertSame($label, $this->model->getKey());
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
    public function wasCreated()
    {
        $actual = $this->model->wasCreated();

        $this->assertIsBool($actual);
        $this->assertTrue($actual);
    }

    /** @test */
    public function wasUpdated()
    {
        $notUpdated = $this->model->wasUpdated();
        $this->assertIsBool($notUpdated);
        $this->assertFalse($notUpdated);

        $this->model->update([
            'name_first' => 'Taylor',
            'name_last' => 'Hall'
        ]);
        $updated = $this->model->wasUpdated();
        $this->assertIsBool($updated);
        $this->assertTrue($updated);
    }

    /** @test */
    public function wasDeleted()
    {
        $notDeleted = $this->model->wasDeleted();
        $this->assertIsBool($notDeleted);
        $this->assertFalse($notDeleted);


        $this->model->delete();
        $deleted = $this->model->wasDeleted();
        $this->assertIsBool($deleted);
        $this->assertTrue($deleted);
    }

    /** @test */
    public function mostRecentChange()
    {
        $expected = 'created';
        $actual = $this->model->mostRecentChange();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function getDatetimeAttribute()
    {
        $expected = date('Y-m-d h:i a', strtotime($this->model->created_at));
        $actual = $this->model->datetime;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getDatetimeAttribute());
    }

    /** @test */
    public function getTimestampFormat()
    {
        $expected = 'Y-m-d h:i a';
        $actual = $this->model->getTimestampFormat();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function getUploadDirectory()
    {
        $uploadDirectory = $this->model->getUploadDirectory();
        $this->assertIsString($uploadDirectory);
        $this->assertTrue($uploadDirectory == "files/{$this->model->getTableName()}/{$this->model->getKey()}");
    }
}
