<?php
/**
 * Petfinder Exception Unauthorized access
 *
 * @package Petfinder
 * @subpackage Exceptions
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Exceptions;

class Unauthorized extends Exception
{
    /**
     * @var int
     */
    protected $code = 300;

    /**
     * @var string
     */
    protected $name = 'PFAPI_ERR_UNAUTHORIZED';

    /**
     * @var string
     */
    protected $message = 'Request is unauthorized';
}