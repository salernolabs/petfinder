<?php
/**
 * Pet Response Data
 *
 * @package Petfinder
 * @subpackage Responses
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Responses;

class PetList
{
    /**
     * @var integer
     */
    public $count = 0;

    /**
     * @var integer
     */
    public $lastOffset;

    /**
     * @var Pet[]
     */
    public $pets = [];

    /**
     * PetList constructor.
     * @param $rawData
     */
    public function __construct($rawData)
    {
        if (!empty($rawData->petfinder->pets->pet))
        {
            $this->count = count($rawData->petfinder->pets->pet);

            foreach ($rawData->petfinder->pets->pet as $rawPetData)
            {
                $this->pets[] = new Pet($rawPetData);
            }
        }

        if (!empty($rawData->petfinder->lastOffset->{'$t'}))
        {
            $this->lastOffset = $rawData->petfinder->lastOffset->{'$t'};
        }
    }
}