<?php


namespace Sfneal\Models\Traits;


/**
 * Trait PublicStatus
 *
 * @package Sfneal\Models\Traits
 * @property $public_status
 */
trait PublicStatusTrait
{
    /**
     * Determine if a Model's 'public_status' is true
     *
     * @return bool
     */
    public function isPublic(): bool {
        return $this->public_status == 1;
    }

    /**
     * Update a Model's 'public_status' attribute
     *
     *  - if a $status is not provided, the $status_id is automatically changed
     *
     * @param int|null $status
     * @return mixed
     */
    public function updatePublicStatus(int $status = null) {
        return $this->update([
            'public_status' => $status ?? ($this->public_status == 1 ? 0 : 1)
        ]);
    }
}
