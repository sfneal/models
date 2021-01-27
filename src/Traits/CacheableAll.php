<?php

namespace Sfneal\Models\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Sfneal\Helpers\Laravel\LaravelHelpers;

trait CacheableAll
{
    use InvalidateModelCache;

    /**
     * Retrieve a Collection of all instances of this model.
     *
     * @param array $columns
     * @return Collection|mixed
     */
    public static function all($columns = ['*'])
    {
        // todo: fix use of serializeHash() function
        return Cache::rememberForever(parent::getTableName().':all#'.LaravelHelpers::serializeHash($columns),
            function () use ($columns) {
                return parent::all($columns);
            }
        );
    }
}
