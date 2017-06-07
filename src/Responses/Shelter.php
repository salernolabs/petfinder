<?php
/**
 * Shelter Response Data
 *
 * @package Petfinder
 * @subpackage Responses
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Responses;

class Shelter
{
    /**
     * @var string
     */
    public $country;

    /**
     * @var float
     */
    public $longitude;

    /**
     * @var float
     */
    public $latitude;

    /**
     * @var string
     */
    public $name;

    /**
     * @var Contact
     */
    public $contact;

    /**
     * @var string
     */
    public $id;

    /**
     * Shelter constructor.
     * @param $rawShelterData
     */
    public function __construct($rawShelterData)
    {
        $this->country = !empty($rawShelterData->country->{'$t'}) ? $rawShelterData->country->{'$t'} : '';
        $this->contact = new Contact($rawShelterData);
        $this->name = !empty($rawShelterData->name->{'$t'}) ? $rawShelterData->name->{'$t'} : '';
        $this->id = !empty($rawShelterData->id->{'$t'}) ? $rawShelterData->id->{'$t'} : '';
        $this->longitude = !empty($rawShelterData->longitude->{'$t'}) ? $rawShelterData->longitude->{'$t'} : '';
        $this->latitude = !empty($rawShelterData->latitude->{'$t'}) ? $rawShelterData->latitude->{'$t'} : '';
    }
}
