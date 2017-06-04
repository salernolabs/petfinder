<?php
/**
 * Petfinder Exception Invalid Request
 *
 * @package Petfinder
 * @subpackage Exceptions
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Exceptions;

class InvalidRequest extends Exception
{
    /**
     * @var int
     */
    protected $code = 200;

    /**
     * @var string
     */
    protected $name = 'PFAPI_ERR_INVALID';

    /**
     * @var string
     */
    protected $message = 'Invalid request';
}