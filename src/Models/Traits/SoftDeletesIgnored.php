<?php

namespace Sfneal\Models\Traits;

trait SoftDeletesIgnored
{
    // todo: add tests

    /**
     * Preventing booting the soft deleting trait for a model.
     *
     * @return void
     */
    public static function bootSoftDeletes()
    {
    }
}
