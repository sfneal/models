<?php

namespace Sfneal\Models\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sfneal\Models\AbstractModel;
use Sfneal\Models\Tests\Factories\PeopleFactory;

class People extends AbstractModel
{
    use HasFactory;

    protected $table = 'people';
    protected $primaryKey = 'person_id';

    protected $fillable = [
        'person_id',
        'name_first',
        'name_last',
        'email',
        'age',
        'address',
        'city',
        'state',
        'zip',
    ];

    protected static function newFactory(): PeopleFactory
    {
        return new PeopleFactory();
    }

    public function getNameFullAttribute(): string
    {
        return "{$this->name_first} {$this->name_last}";
    }

    public function getNameLastFirstAttribute(): string
    {
        return "{$this->name_last}, {$this->name_first}";
    }

    public function getAddressFullAttribute(): string
    {
        return "{$this->address}, {$this->city}, {$this->state} {$this->zip}";
    }
}
