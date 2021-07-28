<?php

namespace Sfneal\Models\Tests\Assets\Models;

use Database\Factories\PeopleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Sfneal\Models\ModelWithPublicStatus;
use Sfneal\Models\Tests\Assets\Builders\PeopleBuilder;

class People extends ModelWithPublicStatus
{
    use HasFactory;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'updated_at', 'created_at'];

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
        'public_status',
    ];

    /**
     * Model Factory.
     *
     * @return PeopleFactory
     */
    protected static function newFactory(): PeopleFactory
    {
        return new PeopleFactory();
    }

    /**
     * Query Builder.
     *
     * @param $query
     * @return PeopleBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new PeopleBuilder($query);
    }

    /**
     * Query Builder method for improved type hinting.
     *
     * @return PeopleBuilder|Builder
     */
    public static function query()
    {
        return parent::query();
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

    public function getAgeAttribute($value): int
    {
        return intval($value);
    }
}
