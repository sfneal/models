<?php


namespace Sfneal\Models\Interfaces;


interface UpdatePublicStatusInterface
{
    /**
     * Determine if a Model is identified as 'public'
     *
     * @return bool
     */
    public function isPublic(): bool;
}
