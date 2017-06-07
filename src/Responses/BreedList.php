<?php
/**
 * Breed Response Data
 *
 * @package Petfinder
 * @subpackage Responses
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Responses;

class BreedList
{
    /**
     * @var string
     */
    public $animal;

    /**
     * @var string
     */
    public $breeds = [];

    /**
     * BreedList constructor.
     * @param $rawData
     */
    public function __construct($rawData)
    {
        $this->animal = $rawData->petfinder->breeds->{'@animal'};

        if (empty($rawData->petfinder->breeds->breed))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Breed information not found in result data.");
        }

        foreach ($rawData->petfinder->breeds->breed as $breed)
        {
            if (empty($breed->{'$t'})) continue;

            $this->breeds[] = $breed->{'$t'};
        }
    }
}