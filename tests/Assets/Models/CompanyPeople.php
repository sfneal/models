<?php

namespace Sfneal\Models\Tests\Assets\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sfneal\Models\Model;
use Sfneal\Models\Tests\Assets\Factories\CompanyPeopleFactory;

class CompanyPeople extends Model
{
    use HasFactory;

    protected $table = 'company_people';
    protected $primaryKey = 'company_person_id';

    protected $fillable = [
        'company_person_id',
        'name_first',
        'name_last',
        'email',
        'age',
        'address',
        'city',
        'state',
        'zip',
    ];

    protected static function newFactory(): CompanyPeopleFactory
    {
        return new CompanyPeopleFactory();
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
