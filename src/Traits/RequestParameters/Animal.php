<?php
/**
 * Adds a function to handle and validate animal types in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Animal
{
    /**
     * Set animal type
     *
     * @param $animal
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setAnimal($animal)
    {
        $validAnimalTypes = ['barnyard' => 1, 'bird' => 1, 'cat' => 1, 'dog' => 1, 'horse' => 1, 'pig' => 1, 'reptile' => 1, 'smallfurry' => 1];

        if (empty($validAnimalTypes[$animal]))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Invalid breed animal type specified, please use any of the following " . implode(', ' , $validAnimalTypes));
        }

        $this->setParameterValue('animal', $animal);

        return $this;
    }
}