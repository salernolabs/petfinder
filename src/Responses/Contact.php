<?php
/**
 * Contact Response Data
 *
 * @package Petfinder
 * @subpackage Responses
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Responses;

class Contact
{
    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $address1;

    /**
     * @var string
     */
    public $address2;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $city;

    /**
     * @var string
     */
    public $state;

    /**
     * @var string
     */
    public $zip;

    /**
     * @var string
     */
    public $fax;

    /**
     * Contact constructor.
     * @param $rawData
     */
    public function __construct($rawData)
    {
        $this->phone = !empty($rawData->phone->{'$t'}) ? $rawData->phone->{'$t'} : '';
        $this->address1 = !empty($rawData->address1->{'$t'}) ? $rawData->address1->{'$t'} : '';
        $this->address2 = !empty($rawData->address2->{'$t'}) ? $rawData->address2->{'$t'} : '';
        $this->email = !empty($rawData->email->{'$t'}) ? $rawData->email->{'$t'} : '';
        $this->city = !empty($rawData->city->{'$t'}) ? $rawData->city->{'$t'} : '';
        $this->state = !empty($rawData->state->{'$t'}) ? $rawData->state->{'$t'} : '';
        $this->zip = !empty($rawData->zip->{'$t'}) ? $rawData->zip->{'$t'} : '';
        $this->fax = !empty($rawData->fax->{'$t'}) ? $rawData->fax->{'$t'} : '';
    }
}