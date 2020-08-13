<?php
namespace Sfneal\Models;

//use App\Builders\QueryBuilder;
use Sfneal\Models\Traits\UploadDirectory;
use DateTimeInterface;
//use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// TODO: create package LaravelModels
abstract class AbstractModel extends Model
{
    use SoftDeletes,
        UploadDirectory;

//    /**
//     * Query Builder.
//     * @param $query
//     * @return QueryBuilder
//     */
//    public function newEloquentBuilder($query) {
//        return new QueryBuilder($query);
//    }
//
//    /**
//     * @return QueryBuilder|Builder
//     */
//    public static function query()
//    {
//        return parent::query();
//    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    /**
     * Max number of hours ago a model instance could have been created ago and considered 'new'
     */
    private const IS_NEW_MAX_HOURS = 168;

    /**
     * Determine if a model instance 'is new' if it was created within the time frame
     *
     * @return bool
     */
    public function isNew(): bool {
        if (empty($this->created_at)) {
            return false;
        }
        return strtotime($this->created_at) >= strtotime('-' . self::IS_NEW_MAX_HOURS . ' hours');
    }

    /**
     * Determine how new a model instance is by subtracting the current time with the created_at time
     *
     * @return false|float
     */
    public function howNew() {
        return round((time() - strtotime($this->created_at)) / (60 * 60 * 24));
    }

    /**
     * Return the value of the 'is new' column (default is 'created_at')
     *
     * @return string
     */
    public function getIsNewColumn() {
        return $this->getCreatedAtColumn();
    }

    /**
     * Determine if a model has an attribute
     *
     *  - Optionally determine if the attribute is fillable.
     *  - Allows $attr to be null for conditionals where a column may not exist
     *
     * @param string $attr
     * @param bool $is_fillable
     * @return bool
     */
    public function hasAttribute(string $attr = null, bool $is_fillable = false): bool {
        // Determine that the attribute exists and optionally weather it is fillable
        return (
            isset($attr) &&
            array_key_exists($attr, $this->attributes) &&
            ($is_fillable ? array_key_exists($attr, $this->fillable) : true)
        );
    }

    /**
     * Determine if a model has attribute that is also null
     *
     * @param string $attr
     * @return bool
     */
    public function hasNullAttribute(string $attr): bool {
        return $this->hasAttribute($attr) && is_null($this->getAttribute($attr));
    }

    /**
     * Retrieve an integer has of the model instance's ID
     *
     * @return int
     */
    public function getIdHashAttribute() {
        return crc32($this->getKey());
    }

    /**
     * Retrieve the 'created_at' attribute mutated to human readable datetime
     *
     * @return string
     */
    public function getDatetimeAttribute(): string
    {
        return date('Y-m-d h:i a', strtotime($this->created_at));
    }

    /**
     * Returns the default 'label' for a model instance
     *
     * @return mixed
     */
    public function getLabel()
    {
        return $this->getKey();
    }

    /**
     * Retrieve a Model's table name statically
     *
     * @return mixed
     */
    public static function getTableName()
    {
        return with(new static)->getTable();
    }

    /**
     * Retrieve a Model's primary key statically
     *
     * @return mixed
     */
    public static function getPrimaryKeyName()
    {
        return with(new static)->getKeyName();
    }

    /**
     * Determine if a Model was recently 'created'
     *
     * @return bool
     */
    public function wasCreated(): bool {
        return $this->wasRecentlyCreated;
    }

    /**
     * Determine if a Model was recently 'updated'
     *
     * @return bool
     */
    public function wasUpdated(): bool {
        return $this->wasChanged();
    }

    /**
     * Determine if a Model was recently 'deleted'
     *
     * @return bool
     */
    public function wasDeleted(): bool {
        return !$this->exists || !is_null($this->deleted_at);
    }

    /**
     * Retrieve the most recent Model change
     *
     * @return string
     */
    public function mostRecentChange(): string {
        if ($this->wasCreated()) {
            return 'created';
        }

        elseif ($this->wasUpdated()) {
            return 'updated';
        }

        elseif ($this->wasDeleted()) {
            return 'deleted';
        }

        else {
            return 'unchanged';
        }
    }
}
