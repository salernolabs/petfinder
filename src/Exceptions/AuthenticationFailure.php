<?php
/**
 * Petfinder Exception Authentication Failure
 *
 * @package Petfinder
 * @subpackage Exceptions
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Exceptions;

class AuthenticationFailure extends Exception
{
    /**
     * @var int
     */
    protected $code = 301;

    /**
     * @var string
     */
    protected $name = 'PFAPI_ERR_AUTHFAIL';

    /**
     * @var string
     */
    protected $message = 'Authentication failure';
}