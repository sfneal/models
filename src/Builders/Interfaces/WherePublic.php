<?php

namespace Sfneal\Builders\Interfaces;

interface WherePublic
{
    /**
     * Scope query results to only results that are public.
     *
     * @param  int  $value
     * @return $this
     */
    public function wherePublic(int $value = 1): self;

    /**
     * Scope query results to only results that are private.
     *
     * @return $this
     */
    public function wherePrivate(): self;
}
