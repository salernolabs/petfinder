<?php
/**
 * Adds a function to handle and validate id types in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait ShelterId
{
    /**
     * Set id
     *
     * @param $shelterId
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setId($shelterId)
    {
        $shelterId = trim(strip_tags($shelterId));

        if (empty($shelterId))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Please enter a valid id for this function.");
        }

        $this->setParameterValue('id', $shelterId);

        return $this;
    }
}