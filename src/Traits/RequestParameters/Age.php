<?php
/**
 * Adds a function to handle and validate animal ages in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Age
{
    /**
     * Set animal age
     *
     * @param $age
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setAge($age)
    {
        $validAges = ['Baby'=>1, 'Young'=>1, 'Adult'=>1, 'Senior'=>1];

        if (empty($validAges[$age]))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Invalid age specified, please use any of the following " . implode(', ' , $validAges));
        }

        $this->setParameterValue('age', $age);

        return $this;
    }
}