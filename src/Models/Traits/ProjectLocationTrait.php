<?php

namespace Sfneal\Models\Traits;

trait ProjectLocationTrait
{
    /**
     * Retrieve a string with the Article's project city, project state.
     *
     * @return string|null
     */
    public function getProjectLocationAttribute()
    {
        if (isset($this->project_city) && isset($this->project_state)) {
            return "{$this->project_city}, {$this->project_state}";
        } else {
            return null;
        }
    }

    /**
     * Parse project_location attribute into city and state values.
     *
     * @param  $value
     */
    public function setProjectLocationAttribute($value)
    {
        if (isset($value)) {
            $city_state = explode(', ', $value);
            $this->attributes['project_city'] = $city_state[0];
            $this->attributes['project_state'] = $city_state[1];
        }
    }
}
