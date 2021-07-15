<?php

namespace Sfneal\Models\Traits;

/**
 * Trait PublicStatus.
 *
 * @property $public_status
 */
trait PublicStatusTrait
{
    /**
     * Determine if a Model's 'public_status' is true.
     *
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->public_status == 1;
    }

    /**
     * Determine if a Model's 'public_status' is false.
     *
     * @return bool
     */
    public function isPrivate(): bool
    {
        return ! $this->isPublic();
    }

    /**
     * Update a Model's 'public_status' attribute.
     *
     *  - if a $status is not provided, the $status_id is automatically changed
     *
     * @param int|null $status
     * @return bool
     */
    public function updatePublicStatus(int $status = null): bool
    {
        return $this->update([
            'public_status' => $status ?? ($this->public_status == 1 ? 0 : 1),
        ]);
    }
}
