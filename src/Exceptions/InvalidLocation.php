<?php
/**
 * Petfinder Exception Invalid Geographical Location
 *
 * @package Petfinder
 * @subpackage Exceptions
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Exceptions;

class InvalidLocation extends Exception
{
    /**
     * @var int
     */
    protected $code = 203;

    /**
     * @var string
     */
    protected $name = 'PFAPI_ERR_LOCATION';

    /**
     * @var string
     */
    protected $message = 'Invalid geographical location';
}