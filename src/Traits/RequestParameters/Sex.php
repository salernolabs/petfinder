<?php
/**
 * Adds a function to handle and validate animal sexes in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Sex
{
    /**
     * Set animal sex
     *
     * @param $sex
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setSex($sex)
    {
        $validSexTypes = ['M'=>1, 'F'=>1];

        if (empty($validSexTypes[$sex]))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Invalid sex specified, please use any of the following " . implode(', ' , $validSexTypes));
        }

        $this->setParameterValue('sex', $sex);

        return $this;
    }
}