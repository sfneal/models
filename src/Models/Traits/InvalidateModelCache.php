<?php

namespace Sfneal\Models\Traits;

use Sfneal\Helpers\Redis\RedisCache;

trait InvalidateModelCache
{
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
