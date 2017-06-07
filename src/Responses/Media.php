<?php
/**
 * Media Response Data
 *
 * @package Petfinder
 * @subpackage Responses
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Responses;

class  Media
{
    /**
     * @var Photo[]
     */
    public $photos = [];

    /**
     * Media constructor.
     * @param $rawData
     */
    public function __construct($rawData)
    {
        foreach ($rawData->photos->photo as $photoRawData)
        {
            $this->photos[] = new Photo($photoRawData);
        }
    }
}