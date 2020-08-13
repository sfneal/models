<?php

namespace Sfneal\Builders\Traits;

trait CountAndPaginate
{
    /**
     * Retrieve raw query results formatted for Ajax select2 form inputs.
     *
     * @param int $per_page
     * @return array
     */
    public function countAndPaginate($per_page = 30)
    {
        return [
            'total_count' => $this->count(),
            'items' => $this->paginate($per_page)->items(),
        ];
    }
}
