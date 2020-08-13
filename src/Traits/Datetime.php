<?php


namespace Sfneal\Models\Traits;


trait Datetime
{
    /**
     * Format a datetime string
     *
     * @param string $format
     * @param string|null $datetime
     * @return string
     */
    private static function datetime(string $format, string $datetime = null): string {
        return (isset($datetime)) ? date($format, strtotime($datetime)) : '';
    }
}
