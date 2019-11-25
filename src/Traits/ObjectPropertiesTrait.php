<?php

namespace App\Traits;

/**
 * Trait ObjectPropertiesTrait
 * @package App\Traits
 */
trait ObjectPropertiesTrait
{
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $result = array_filter(get_object_vars($this), [$this, 'removeHidden'], ARRAY_FILTER_USE_KEY);
        if (isset($this->hidden)) {
            $result = array_filter($result, [$this, 'hideProperties'], ARRAY_FILTER_USE_KEY);
        }

        return $result;
    }

    /**
     * @param $propertyKey
     *
     * @return bool
     */
    private function removeHidden($propertyKey)
    {
        return $propertyKey !== 'hidden';
    }

    /**
     * @param $propertyKey
     *
     * @return bool
     */
    private function hideProperties($propertyKey)
    {
        return !in_array($propertyKey, (array) $this->hidden);
    }
}