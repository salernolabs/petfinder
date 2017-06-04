<?php
/**
 * Petfinder Exception Limit Exceeded
 *
 * @package Petfinder
 * @subpackage Exceptions
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Exceptions;

class LimitExceeded extends Exception
{
    /**
     * @var int
     */
    protected $code = 202;

    /**
     * @var string
     */
    protected $name = 'PFAPI_ERR_LIMIT';

    /**
     * @var string
     */
    protected $message = 'A limit was exceeded';
}