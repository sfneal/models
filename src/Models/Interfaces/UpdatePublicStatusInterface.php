<?php

namespace Sfneal\Models\Interfaces;

interface UpdatePublicStatusInterface
{
    /**
     * Update a Model's 'public_status' attribute.
     *
     *  - if a $status is not provided, the $status_id is automatically changed
     *
     * @param  int|null  $status
     * @return bool
     */
    public function updatePublicStatus(?int $status = null): bool;
}
