<?php
/**
 * Adds a function to handle and validate id types in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Id
{
    /**
     * Set id
     *
     * @param $petId
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setId($itemId)
    {
        $itemId = intval($itemId);

        if (empty($itemId))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Please enter a valid id for this function.");
        }

        $this->setParameterValue('id', $itemId);

        return $this;
    }
}