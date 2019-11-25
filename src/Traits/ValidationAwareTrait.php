<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Request;

/**
 * Trait ValidationAwareTrait
 * @package App\Traits
 */
trait ValidationAwareTrait
{
    /** @var Request */
    protected $httpRequest;

    /**
     * @param $property
     *
     * @return |null
     */
    public function __get($property)
    {
        if (property_exists($this->httpRequest, $property)) {
            return $this->httpRequest->$property;
        }

        $trace = debug_backtrace();
        $fileName = $trace[0]['file'] ?? __FILE__;
        $line = $trace[0]['line'] ?? __LINE__;
        trigger_error("Undefined property {$property} in {$fileName} on line {$line}");

        return null;
    }

    /**
     * @param $property
     * @param $value
     *
     * @return $this
     */
    public function __set($property, $value)
    {
        if (property_exists($this->httpRequest, $property)) {
            $this->httpRequest->$property = $value;
        }

        return $this;
    }

    /**
     * @param $property
     *
     * @return bool
     */
    public function __isset($property)
    {
        return isset($this->httpRequest->$property);
    }

    /**
     * @param $property
     */
    public function __unset($property)
    {
        unset($this->httpRequest->$property);
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return |null
     */
    public function __call($name, $arguments)
    {
        if (\method_exists($this->httpRequest, $name)) {
            return $this->httpRequest->$name(...$arguments);
        }

        $trace = debug_backtrace();
        $fileName = $trace[0]['file'] ?? __FILE__;
        $line = $trace[0]['line'] ?? __LINE__;
        trigger_error(\sprintf('Attempted to call an undefined method named "%s" of class "%s" in %s on line %d', $name, \get_class($this), $fileName, $line));

        return null;
    }
}