<?php

namespace Sfneal\Builders;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Sfneal\Builders\Traits\CountAndPaginate;

class QueryBuilder extends EloquentBuilder
{
    use CountAndPaginate;

    /**
     * @var string Declare a custom MySQL select string to be used by selectRawJson()
     */
    protected $selectRawJson;

    /**
     * @var Model
     */
    protected $targetModel;

    /**
     * @var string Name of the User model's table
     */
    protected $tableName;

    /**
     * @var string Name of the User model's primary key
     */
    protected $primaryKeyName;

    /**
     * UserBuilder constructor.
     *
     * @param Builder $query
     */
    public function __construct(Builder $query)
    {
        $this->setTableAndKeyNames();
        parent::__construct($query);
    }

    /**
     * Set the $tableName & $primaryKeyName properties.
     *
     * @return void
     */
    private function setTableAndKeyNames(): void
    {
        // Only declare table & pk if the target model is declared
        if (isset($this->targetModel)) {
            $this->tableName = $this->targetModel::getTableName();
            $this->primaryKeyName = $this->targetModel::getPrimaryKeyName();
        }
    }

    /**
     * Retrieve a concatenation string that combines two columns in a table into a single column.
     *
     * @param string $column1
     * @param string $column2
     * @param string $delimiter
     * @return string
     */
    protected function concatColumns(string $column1, string $column2, string $delimiter = ' '): string
    {
        // Prepend table name if its been declared
        $column1 = (isset($this->tableName)) ? "{$this->tableName}.{$column1}" : $column1;
        $column2 = (isset($this->tableName)) ? "{$this->tableName}.{$column2}" : $column2;

        // Return concatenate the two columns using the delimiter
        return "concat({$column1}, '{$delimiter}', {$column2})";
    }

    /**
     * Retrieve a MySQL if statement that can be used within a query.
     *
     * @param string $condition
     * @param string $expr_true
     * @param string $expr_false
     * @return string
     */
    protected function ifStatement(string $condition, string $expr_true, string $expr_false): string
    {
        return "if({$condition}, {$expr_true}, {$expr_false})";
    }

    /**
     * Wildcard where like query to determine if any part of the value is found.
     *
     * @param string $column
     * @param $value
     * @param bool $leadingWildcard
     * @param bool $trailingWildcard
     * @return $this
     */
    public function whereLike(string $column, $value, bool $leadingWildcard = true, bool $trailingWildcard = true): self
    {
        $this->where(
            $column,
            'LIKE',
            ($leadingWildcard ? '%' : '').$value.($trailingWildcard ? '%' : '')
        );

        return $this;
    }

    /**
     * Wildcard or where like query to determine if any part of the value is found.
     *
     * @param string $column
     * @param $value
     * @param bool $leadingWildcard
     * @param bool $trailingWildcard
     * @return $this
     */
    public function orWhereLike(string $column, $value, bool $leadingWildcard = true, bool $trailingWildcard = true): self
    {
        $this->orWhere(
            $column,
            'LIKE',
            ($leadingWildcard ? '%' : '').$value.($trailingWildcard ? '%' : '')
        );

        return $this;
    }

    /**
     * Retrieve a flat, single-dimensional array of results without keys.
     *
     * @param string $column
     * @return array
     */
    public function getFlatArray(string $column): array
    {
        return array_map(function ($collection) use ($column) {
            return $collection[$column];
        }, $this->distinct()->get($column)->toArray());
    }

    /**
     * Retrieve raw query results formatted for Ajax select2 form inputs.
     *
     * @param string|null $raw
     * @return $this
     */
    public function selectRawJson(string $raw = null): self
    {
        $this->withoutGlobalScopes();
        $this->selectRaw($raw ?? $this->selectRawJson);

        return $this;
    }

    /**
     * Order query results by the 'created_at' column.
     *
     * @param string $direction
     * @return $this
     */
    public function orderByCreatedAt(string $direction = 'desc'): self
    {
        $this->orderBy('created_at', $direction);

        return $this;
    }

    /**
     * Retrieve the 'next' Model in the database.
     *
     * @param int|null $model_id
     * @return QueryBuilder|Collection|Model|null
     */
    public function getNextModel(int $model_id = null)
    {
        return $this->find($this->getNextModelId($model_id));
    }

    /**
     * Retrieve the 'previous' Model in the database.
     *
     * @param int|null $model_id
     * @return QueryBuilder|Collection|Model|null
     */
    public function getPreviousModel(int $model_id = null)
    {
        return $this->find($this->getPreviousModelId($model_id));
    }

    /**
     * Retrieve the 'next' Model's ID.
     *
     * @param int|null $model_id
     * @return mixed
     */
    public function getNextModelId(int $model_id = null)
    {
        return $this
            ->where($this->model->getKeyName(), '>', $model_id ?? $this->model->getKey())
            ->min($this->model->getKeyName());
    }

    /**
     * Retrieve the 'previous' Model's ID.
     *
     * @param int|null $model_id
     * @return mixed
     */
    public function getPreviousModelId(int $model_id = null)
    {
        return $this
            ->where($this->model->getKeyName(), '<', $model_id ?? $this->model->getKey())
            ->max($this->model->getKeyName());
    }
}
