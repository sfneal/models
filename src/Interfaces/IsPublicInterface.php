<?php


namespace Sfneal\Models\Interfaces;


interface IsPublicInterface
{
    /**
     * Determine if a Model is identified as 'public'
     *
     * @return bool
     */
    public function isPublic(): bool;
}
