<?php

namespace Sfneal\Models\Traits;

trait UploadDirectory
{
    /**
     * Get the AWS S3 file upload directory for an Inquiry model by retrieving the table name and primary key.
     *
     * @param  string  $base_dir
     * @return string
     */
    public function getUploadDirectory($base_dir = 'files'): string
    {
        return $base_dir.'/'.str_replace('_', '-', $this->getTable()).'/'.$this->getKey();
    }
}
