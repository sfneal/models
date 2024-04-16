<?php

namespace Sfneal\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sfneal\Builders\QueryBuilder;
use Sfneal\Models\Traits\UploadDirectory;

#[\AllowDynamicProperties]
abstract class Model extends EloquentModel
{
    use SoftDeletes;
    use UploadDirectory;

    /**
     * Retrieve the datetime format used in the timestamp attribute accessors.
     *
     * @return string
     */
    protected $timestampFormat = 'Y-m-d h:i a';

    /**
     * Query Builder.
     *
     * @param  $query
     * @return QueryBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new QueryBuilder($query);
    }

    /**
     * @return QueryBuilder|Builder
     */
    public static function query()
    {
        return parent::query();
    }

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
     * Max number of hours ago a model instance could have been created ago and considered 'new'.
     */
    private const IS_NEW_MAX_HOURS = 168;

    /**
     * Determine if a model instance 'is new' if it was created within the time frame.
     *
     * @return bool
     */
    public function isNew(): bool
    {
        if (empty($this->attributes['created_at'])) {
            return false;
        }

        return strtotime($this->attributes['created_at']) >= strtotime('-'.self::IS_NEW_MAX_HOURS.' hours');
    }

    /**
     * Determine how new a model instance is by subtracting the current time with the created_at time.
     *
     * @return float
     */
    public function howNew(): float
    {
        return round((time() - strtotime($this->attributes['created_at'])) / (60 * 60 * 24));
    }

    /**
     * Return the value of the 'is new' column (default is 'created_at').
     *
     * @return string
     */
    public function getIsNewColumn()
    {
        return $this->getCreatedAtColumn();
    }

    /**
     * Determine if a model has an attribute.
     *
     *  - Optionally determine if the attribute is fillable.
     *  - Allows $attr to be null for conditionals where a column may not exist
     *
     * @param  string  $key
     * @return bool
     */
    public function hasAttribute($key): bool
    {
        // Determine that the attribute exists
        return array_key_exists($key, $this->attributesToArray());
    }

    /**
     * Determine if a model has an attribute.
     *
     *  - Optionally determine if the attribute is fillable.
     *  - Allows $attr to be null for conditionals where a column may not exist
     *
     * @param  string  $key
     * @return bool
     */
    public function hasAttributeFillable($key): bool
    {
        // Determine that the attribute exists and weather it is fillable
        return
            array_key_exists($key, $this->attributesToArray()) &&
            in_array($key, $this->getFillable());
    }

    /**
     * Determine if a model has attribute that is also null.
     *
     * @param  string  $attr
     * @return bool
     */
    public function hasNullAttribute(string $attr): bool
    {
        return $this->hasAttribute($attr) && is_null($this->getAttribute($attr));
    }

    /**
     * Retrieve an integer has of the model instance's ID.
     *
     * @return int
     */
    public function getIdHashAttribute(): int
    {
        return crc32($this->getKey());
    }

    /**
     * Returns the default 'label' for a model instance.
     *
     * @return mixed
     */
    public function getLabel()
    {
        return $this->getKey();
    }

    /**
     * Retrieve a Model's table name statically.
     *
     * @return mixed
     */
    public static function getTableName()
    {
        /** @phpstan-ignore-next-line */
        return (new static)->getTable();
    }

    /**
     * Retrieve a Model's primary key statically.
     *
     * @return mixed
     */
    public static function getPrimaryKeyName()
    {
        /** @phpstan-ignore-next-line */
        return (new static)->getKeyName();
    }

    /**
     * Determine if a Model was recently 'created'.
     *
     * @return bool
     */
    public function wasCreated(): bool
    {
        return $this->wasRecentlyCreated;
    }

    /**
     * Determine if a Model was recently 'updated'.
     *
     * @return bool
     */
    public function wasUpdated(): bool
    {
        return $this->wasChanged();
    }

    /**
     * Determine if a Model was recently 'deleted'.
     *
     * @return bool
     */
    public function wasDeleted(): bool
    {
        if (! $this->exists) {
            return true;
        }

        if (array_key_exists('deleted_at', $this->attributes)) {
            return ! is_null($this->attributes['deleted_at']);
        }

        return false;
    }

    /**
     * Retrieve the most recent Model change.
     *
     * @return string
     */
    public function mostRecentChange(): string
    {
        if ($this->wasCreated()) {
            return 'created';
        } elseif ($this->wasUpdated()) {
            return 'updated';
        } elseif ($this->wasDeleted()) {
            return 'deleted';
        } else {
            return 'unchanged';
        }
    }

    /**
     * Retrieve the 'timestampFormat' property.
     *
     * @return string
     */
    public function getTimestampFormat(): string
    {
        return $this->timestampFormat;
    }

    /**
     * Retrieve the 'timestampFormatForHumans' property.
     *
     * @param  int  $stringToTime
     * @return string
     */
    protected function getDatetimeForHumans(int $stringToTime): string
    {
        return date('F j, Y', $stringToTime).' at '.date('g:i a', $stringToTime);
    }

    /**
     * Retrieve the 'created_at' attribute mutated to human readable datetime.
     *
     * @return string
     */
    public function getDatetimeAttribute(): string
    {
        return date('Y-m-d h:i a', strtotime($this->attributes['created_at']));
    }

    /**
     * Retrieve the 'created_at' attribute mutated to timestamp string.
     *
     *  - 'created_timestamp' attribute accessor
     *
     * @return string
     */
    public function getCreatedTimestampAttribute(): string
    {
        return date($this->getTimestampFormat(), strtotime($this->attributes['created_at']));
    }

    /**
     * Retrieve the 'created_for_humans' attribute mutated to a timestamp for humans string.
     *
     *  - 'created_for_humans' attribute accessor
     *
     * @return string
     */
    public function getCreatedForHumansAttribute(): string
    {
        return $this->getDatetimeForHumans(strtotime($this->attributes['created_at']));
    }

    /**
     * Retrieve the 'created_at' attribute mutated to difference for humans string.
     *
     *  - 'created_for_humans' attribute accessor
     *
     * @return string
     */
    public function getCreatedDiffForHumansAttribute(): string
    {
        return (new Carbon($this->attributes['created_at']))->diffForHumans();
    }

    /**
     * Access the 'creation_date' attribute that returns the attribute in 'Y-m-d' format.
     *
     * @return string
     */
    public function getCreatedDateAttribute(): string
    {
        return date('Y-m-d', strtotime($this->attributes['created_at']));
    }

    /**
     * Access the 'creation_time' attribute that returns the attribute in 'h:i A' format.
     *
     * @return string
     */
    public function getCreatedTimeAttribute(): string
    {
        return date('h:i A', strtotime($this->attributes['created_at']));
    }

    /**
     * Retrieve the 'updated_at' attribute mutated to timestamp string.
     *
     *  - 'updated_timestamp' attribute accessor
     *
     * @return string
     */
    public function getUpdatedTimestampAttribute(): string
    {
        return date($this->getTimestampFormat(), strtotime($this->attributes['updated_at']));
    }

    /**
     * Retrieve the 'updated_for_humans' attribute mutated to a timestamp for humans string.
     *
     *  - 'updated_for_humans' attribute accessor
     *
     * @return string
     */
    public function getUpdatedForHumansAttribute(): string
    {
        return $this->getDatetimeForHumans(strtotime($this->attributes['updated_at']));
    }

    /**
     * Retrieve the 'updated_at' attribute mutated to difference for humans string.
     *
     *  - 'updated_for_humans' attribute accessor
     *
     * @return string
     */
    public function getUpdatedDiffForHumansAttribute(): string
    {
        return (new Carbon($this->attributes['updated_at']))->diffForHumans();
    }

    /**
     * Access the 'updated_date' attribute that returns the attribute in 'Y-m-d' format.
     *
     * @return string
     */
    public function getUpdatedDateAttribute(): string
    {
        return date('Y-m-d', strtotime($this->attributes['updated_at']));
    }

    /**
     * Access the 'updated_time' attribute that returns the attribute in 'h:i A' format.
     *
     * @return string
     */
    public function getUpdatedTimeAttribute(): string
    {
        return date('h:i A', strtotime($this->attributes['updated_at']));
    }
}
