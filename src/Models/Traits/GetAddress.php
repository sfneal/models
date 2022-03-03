<?php

namespace Sfneal\Models\Traits;

trait GetAddress
{
    /**
     * Retrieve a file path for a file type.
     *
     * @param  string  $type
     * @return mixed
     */
    public function getAddress(string $type)
    {
        return $this->addresses->where('type', '=', $type)->first();
    }
}
