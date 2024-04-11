<?php

namespace Sfneal\Models\Tests\Unit;

use Sfneal\Models\Tests\ModelTestCase;

class ModelTest extends ModelTestCase
{
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
        $this->assertTrue($this->model->hasAttribute('name_first'));
        $this->assertTrue($this->model->hasAttribute('name_last'));
        $this->assertTrue($this->model->hasAttribute('email'));
        $this->assertTrue($this->model->hasAttribute('age'));
        $this->assertTrue($this->model->hasAttribute('address'));
        $this->assertTrue($this->model->hasAttribute('city'));
        $this->assertTrue($this->model->hasAttribute('state'));
        $this->assertTrue($this->model->hasAttribute('zip'));
        $this->assertTrue($this->model->hasAttribute('public_status'));

        $this->assertFalse($this->model->hasAttributeFillable('name_full'));
        $this->assertFalse($this->model->hasAttributeFillable('name_last_first'));
        $this->assertFalse($this->model->hasAttributeFillable('address_full'));
        $this->assertFalse($this->model->hasAttributeFillable('address_latest'));
        $this->assertFalse($this->model->hasAttributeFillable('name_full_with_suffix'));
        $this->assertFalse($this->model->hasAttributeFillable('address_city'));
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
            'name_last' => 'Hall',
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
    public function getCreatedTimestampAttribute()
    {
        $expected = date($this->model->getTimestampFormat(), strtotime($this->model->created_at));
        $actual = $this->model->created_timestamp;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getCreatedTimestampAttribute());
    }

    /** @test */
    public function getCreatedForHumansAttribute()
    {
        $expected = date('F j, Y', strtotime($this->model->created_at)).' at '.date('g:i a', strtotime($this->model->created_at));
        $actual = $this->model->created_for_humans;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getCreatedForHumansAttribute());
    }

    /** @test */
    public function getCreatedDiffForHumansAttribute()
    {
        $expected = $this->model->created_at->diffForHumans();
        $actual = $this->model->created_diff_for_humans;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getCreatedDiffForHumansAttribute());
    }

    /** @test */
    public function getCreatedDateAttribute()
    {
        $expected = date('Y-m-d', strtotime($this->model->created_at));
        $actual = $this->model->created_date;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getCreatedDateAttribute());
    }

    /** @test */
    public function getCreatedTimeAttribute()
    {
        $expected = date('h:i A', strtotime($this->model->created_at));
        $actual = $this->model->created_time;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getCreatedTimeAttribute());
    }

    /** @test */
    public function getUpdatedTimestampAttribute()
    {
        $expected = date($this->model->getTimestampFormat(), strtotime($this->model->updated_at));
        $actual = $this->model->updated_timestamp;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getUpdatedTimestampAttribute());
    }

    /** @test */
    public function getUpdatedForHumansAttribute()
    {
        $expected = date('F j, Y', strtotime($this->model->updated_at)).' at '.date('g:i a', strtotime($this->model->updated_at));
        $actual = $this->model->updated_for_humans;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getUpdatedForHumansAttribute());
    }

    /** @test */
    public function getUpdatedDiffForHumansAttribute()
    {
        $expected = $this->model->updated_at->diffForHumans();
        $actual = $this->model->updated_diff_for_humans;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getUpdatedDiffForHumansAttribute());
    }

    /** @test */
    public function getUpdatedDateAttribute()
    {
        $expected = date('Y-m-d', strtotime($this->model->updated_at));
        $actual = $this->model->updated_date;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getUpdatedDateAttribute());
    }

    /** @test */
    public function getUpdatedTimeAttribute()
    {
        $expected = date('h:i A', strtotime($this->model->updated_at));
        $actual = $this->model->updated_time;

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->getUpdatedTimeAttribute());
    }

    /** @test */
    public function getUploadDirectory()
    {
        // todo: refactor to a trait test class
        $uploadDirectory = $this->model->getUploadDirectory();
        $this->assertIsString($uploadDirectory);
        $this->assertTrue($uploadDirectory == "files/{$this->model->getTableName()}/{$this->model->getKey()}");
    }
}
