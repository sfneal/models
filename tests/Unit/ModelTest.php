<?php

namespace Sfneal\Models\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Sfneal\Models\Tests\ModelTestCase;

class ModelTest extends ModelTestCase
{
    #[Test]
    public function isNew()
    {
        $this->assertTrue($this->model->isNew());
    }

    #[Test]
    public function howNew()
    {
        $this->assertIsFloat($this->model->howNew());
    }

    #[Test]
    public function getIsNewColumn()
    {
        $expected = 'created_at';
        $actual = $this->model->getIsNewColumn();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    #[Test]
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

    #[Test]
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

    #[Test]
    public function getIdHashAttribute()
    {
        $expected = crc32($this->model->getKey());
        $actual = $this->model->idHash();

        $this->assertIsInt($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->idHash());
    }

    #[Test]
    public function getLabel()
    {
        $label = $this->model->getLabel();
        $this->assertSame($label, $this->model->getKey());
    }

    #[Test]
    public function getTableName()
    {
        $tableName = $this->model->getTableName();
        $this->assertIsString($tableName);
        $this->assertTrue($tableName == 'people');
    }

    #[Test]
    public function getPrimaryKeyName()
    {
        $primaryKey = $this->model->getPrimaryKeyName();
        $this->assertIsString($primaryKey);
        $this->assertTrue($primaryKey == 'person_id');
    }

    #[Test]
    public function wasCreated()
    {
        $actual = $this->model->wasCreated();

        $this->assertIsBool($actual);
        $this->assertTrue($actual);
    }

    #[Test]
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

    #[Test]
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

    #[Test]
    public function mostRecentChange()
    {
        $expected = 'created';
        $actual = $this->model->mostRecentChange();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    #[Test]
    public function getDatetimeAttribute()
    {
        $expected = date('Y-m-d h:i a', strtotime($this->model->created_at));
        $actual = $this->model->datetime();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->datetime());
    }

    #[Test]
    public function getTimestampFormat()
    {
        $expected = 'Y-m-d h:i a';
        $actual = $this->model->getTimestampFormat();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
    }

    #[Test]
    public function getCreatedTimestampAttribute()
    {
        $expected = date($this->model->getTimestampFormat(), strtotime($this->model->created_at));
        $actual = $this->model->createdTimestamp();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->createdTimestamp());
    }

    #[Test]
    public function getCreatedForHumansAttribute()
    {
        $expected = date('F j, Y', strtotime($this->model->created_at)).' at '.date('g:i a', strtotime($this->model->created_at));
        $actual = $this->model->createdForHumans();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->createdForHumans());
    }

    #[Test]
    public function getCreatedDiffForHumansAttribute()
    {
        $expected = $this->model->created_at->diffForHumans();
        $actual = $this->model->createdDiffForHumans();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->createdDiffForHumans());
    }

    #[Test]
    public function getCreatedDateAttribute()
    {
        $expected = date('Y-m-d', strtotime($this->model->created_at));
        $actual = $this->model->createdDate();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->createdDate());
    }

    #[Test]
    public function getCreatedTimeAttribute()
    {
        $expected = date('h:i A', strtotime($this->model->created_at));
        $actual = $this->model->createdTime();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->createdTime());
    }

    #[Test]
    public function getUpdatedTimestampAttribute()
    {
        $expected = date($this->model->getTimestampFormat(), strtotime($this->model->updated_at));
        $actual = $this->model->updatedTimestamp();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->updatedTimestamp());
    }

    #[Test]
    public function getUpdatedForHumansAttribute()
    {
        $expected = date('F j, Y', strtotime($this->model->updated_at)).' at '.date('g:i a', strtotime($this->model->updated_at));
        $actual = $this->model->updatedForHumans();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->updatedForHumans());
    }

    #[Test]
    public function getUpdatedDiffForHumansAttribute()
    {
        $expected = $this->model->updated_at->diffForHumans();
        $actual = $this->model->updatedDiffForHumans();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->updatedDiffForHumans());
    }

    #[Test]
    public function getUpdatedDateAttribute()
    {
        $expected = date('Y-m-d', strtotime($this->model->updated_at));
        $actual = $this->model->updatedDate();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->updatedDate());
    }

    #[Test]
    public function getUpdatedTimeAttribute()
    {
        $expected = date('h:i A', strtotime($this->model->updated_at));
        $actual = $this->model->updatedTime();

        $this->assertIsString($actual);
        $this->assertSame($expected, $actual);
        $this->assertSame($actual, $this->model->updatedTime());
    }

    #[Test]
    public function getUploadDirectory()
    {
        // todo: refactor to a trait test class
        $uploadDirectory = $this->model->getUploadDirectory();
        $this->assertIsString($uploadDirectory);
        $this->assertTrue($uploadDirectory == "files/{$this->model->getTableName()}/{$this->model->getKey()}");
    }
}
