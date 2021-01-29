<?php

namespace Sfneal\Builders\Interfaces;

interface WherePublic
{
    /**
     * Scope query results to only results that are public.
     *
     * @return $this
     */
    public function wherePublic(): self;

    /**
     * Scope query results to only results that are private.
     *
     * @return $this
     */
    public function wherePrivate(): self;
}
