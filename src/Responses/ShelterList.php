<?php
/**
 * Shelter Response Data
 *
 * @package Petfinder
 * @subpackage Responses
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Responses;

class ShelterList
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
     * @var Shelter[]
     */
    public $shelters = [];

    /**
     * ShelterList constructor.
     * @param $rawData
     */
    public function __construct($rawData)
    {
        if (!empty($rawData->petfinder->shelters->shelter))
        {
            $this->count = count($rawData->petfinder->shelters->shelter);

            foreach ($rawData->petfinder->shelters->shelter as $rawShelterData)
            {
                $this->shelters[] = new Shelter($rawShelterData);
            }
        }

        if (!empty($rawData->petfinder->lastOffset->{'$t'}))
        {
            $this->lastOffset = $rawData->petfinder->lastOffset->{'$t'};
        }
    }
}