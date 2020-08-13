<?php

namespace Sfneal\Builders\Traits;

use Illuminate\Database\Eloquent\Builder;

trait WhereBetweenSplitter
{
    /**
     * whereBetween clause extension that accepts a string value instead of array.
     *
     * @param string $column DB column
     * @param string|mixed $values Two 'between' values with a separator
     * @param string $sep separator character
     * @param bool $allow_where Allow for standard 'where' clause $values cannot be split
     * @param string $where_operator
     * @return WhereBetweenSplitter|Builder
     */
    public function whereBetweenSplitter(string $column, $values, string $sep = '-', bool $allow_where = true, $where_operator = '=')
    {
        // Use standard whereBetween if $values is an array
        if (self::isArrayValue($values)) {
            $this->whereBetween($column, $values);
        }

        // Determine if the $value is splitable
        elseif (! self::isSplitableValue($values, $sep) && $allow_where) {
            $this->where($column, $where_operator, $values);
        }

        // $values is a string and that $sep is in $values
        else {
            $this->whereBetween($column, array_map(function ($str) {
                return trim($str);
            }, explode($sep, $values)));
        }

        return $this;
    }

    /**
     * Determine if the values to be split are 'splitable'.
     *
     * Value is splittable if...
     *  - A standard 'where' clause can be used
     *  - $values is not a string
     *  - $sep is found not in $values
     *
     * @param $values
     * @param string $sep
     * @return bool
     */
    private static function isSplitableValue($values, string $sep = '-')
    {
        return is_string($values) && inString($values, $sep);
    }

    /**
     * Determine if the values are valid for use in standard 'whereBetween' clause.
     *
     * @param $values
     * @return bool
     */
    private static function isArrayValue($values)
    {
        return is_array($values) && count($values) > 1;
    }
}
