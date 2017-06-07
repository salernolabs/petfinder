<?php
/**
 * Photo Response Data
 *
 * @package Petfinder
 * @subpackage Responses
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Responses;

class Photo
{
    /**
     * @var string
     */
    public $size;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $id;

    /**
     * Photo constructor.
     * @param $rawData
     */
    public function __construct($rawData)
    {
        $this->size = !empty($rawData->{'@size'}) ? $rawData->{'@size'} : '';
        $this->url = !empty($rawData->{'$t'}) ? $rawData->{'$t'} : '';
        $this->id = !empty($rawData->{'@id'}) ? $rawData->{'@id'} : '';
    }
}