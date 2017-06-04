<?php
/**
 * Adds a function to handle and validate breed types in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Breed
{
    /**
     * Set breed type
     *
     * @param $breed
     * @return $this
     */
    public function setBreed($breed)
    {
        $this->setParameterValue('breed', $breed);

        return $this;
    }
}