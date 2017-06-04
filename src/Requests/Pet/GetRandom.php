<?php
/**
 * Implements the pet.getRandom API command
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Pet;

class GetRandom extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'pet.getRandom';

    use \SalernoLabs\Petfinder\Traits\RequestParameters\Animal,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Breed,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Size,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Sex,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Location;

    /**
     * Set shelter id
     *
     * @param $shelterId
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setShelterId($shelterId)
    {
        $shelterId = intval($shelterId);

        if (empty($shelterId))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Please enter a valid numeric shelter id.");
        }

        $this->setParameterValue('shelterid', $shelterId);

        return $this;
    }

    /**
     * Set output type
     *
     * @param $outputType
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setOutputType($outputType)
    {
        $validOutputTypes = ['id' => 1, 'basic' => 1, 'full' => 1];

        if (empty($validOutputTypes[$outputType]))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Invalid output type specified, please use any of the following " . implode(', ' , $validOutputTypes));
        }

        $this->setParameterValue('output', $outputType);

        return $this;
    }
}