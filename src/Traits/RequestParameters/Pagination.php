<?php
/**
 * Adds a function to handle and validate pagination in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Pagination
{
    /**
     * Set offset, usually use the value from lastOffset from the prior pet.find for this
     *
     * @param $offset
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setOffset($offset)
    {
        $offset = intval($offset);

        $this->setParameterValue('offset', $offset);

        return $this;
    }

    /**
     * Set count parameter
     *
     * @param $count
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setCount($count)
    {
        $count = intval($count);

        if (empty($count))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Invalid count specified.");
        }

        $this->setParameterValue('count', $count);

        return $this;
    }
}