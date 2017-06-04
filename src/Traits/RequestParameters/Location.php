<?php
/**
 * Adds a function to handle and validate breed types in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Location
{
    /**
     * Set location to search
     *
     * @param $location
     * @return $this
     */
    public function setLocation($location)
    {
        $this->setParameterValue('location', $location);

        return $this;
    }
}