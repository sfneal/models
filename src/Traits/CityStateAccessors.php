<?php


namespace Sfneal\Models\Traits;


trait CityStateAccessors
{
    /**
     * Retrieve the Subdivision's city state string
     *
     * @return string
     */
    public function getCityStateAttribute() {
        return implodeFiltered(', ', [$this->city, $this->state]);
    }

    /**
     * Retrieve the Subdivision's city state string
     *
     * @return string
     */
    public function getCityStateZipAttribute() {
        return implodeFiltered(' ', [$this->city_state, $this->zip]);
    }
}
