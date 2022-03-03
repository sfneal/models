<?php

namespace Sfneal\Models\Tests\Assets\Builders;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Query\Builder;
use Sfneal\Builders\QueryBuilder;
use Sfneal\Builders\Traits\WhereBetweenSplitter;
use Sfneal\Builders\Traits\WherePublicStatus;
use Sfneal\Models\Tests\Assets\Models\People;

class PeopleBuilder extends QueryBuilder
{
    use WhereBetweenSplitter;
    use WherePublicStatus;

    /**
     * @var EloquentModel|People
     */
    protected $targetModel = People::class;

    /**
     * UserBuilder constructor.
     *
     * @param  Builder  $query
     */
    public function __construct(Builder $query)
    {
        parent::__construct($query);
        $this->setSelectRawJson();
    }

    /**
     * Dynamically set the $selectRawJson.
     *
     * @return void
     */
    private function setSelectRawJson(): void
    {
        $this->selectRawJson = "{$this->tableName}.{$this->primaryKeyName} as id, {$this->concatName()} as text";
    }

    /**
     * Retrieve the User model's 'name' attribute by concatenating first and last name columns.
     *
     * @return string
     */
    private function concatName(): string
    {
        return $this->concatColumns('name_first', 'name_last');
    }
}
