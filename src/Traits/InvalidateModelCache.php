<?php

namespace Sfneal\Models\Traits;

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
        return redisDelete(parent::getTableName().(isset($key) ? ":{$key}" : ''));
    }
}
