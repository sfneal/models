<?php

namespace Sfneal\Models\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Sfneal\Helpers\Laravel\LaravelHelpers;
use Sfneal\Helpers\Redis\RedisCache;

trait CacheableAll
{
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

    /**
     * Invalidate a Model's cache.
     *
     * @param string|null $key
     * @return array
     */
    public static function invalidateCache(string $key = null)
    {
        return RedisCache::delete(parent::getTableName().(isset($key) ? ":{$key}" : ''));
    }
}
