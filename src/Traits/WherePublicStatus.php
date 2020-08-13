<?php

namespace Sfneal\Builders\Traits;

trait WherePublicStatus
{
    /**
     * Scope query results to only results that are public.
     *
     * @param int $value
     * @return $this
     */
    public function wherePublic($value = 1)
    {
        $this->where('public_status', '=', 1);

        return $this;
    }

    /**
     * Scope query results to only results that are private.
     *
     * @return $this
     */
    public function wherePrivate()
    {
        $this->wherePublic(0);

        return $this;
    }
}
