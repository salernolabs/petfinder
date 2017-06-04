<?php
/**
 * Adds a function to handle and validate size types in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Size
{
    /**
     * Set size
     *
     * @param $size
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setSize($size)
    {
        $validSizeTypes = ['S'=>1, 'M'=>1, 'L'=>1, 'XL'=>1];

        if (empty($validSizeTypes[$size]))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Invalid size type specified, please use any of the following " . implode(', ' , $validSizeTypes));
        }

        $this->setParameterValue('size', $size);

        return $this;
    }
}