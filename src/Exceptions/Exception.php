<?php
/**
 * Petfinder Generic Exception
 *
 * @package Petfinder
 * @subpackage Exceptions
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Exceptions;

class Exception extends \Exception
{
    /**
     * @var int
     */
    protected $code = 999;

    /**
     * @var string
     */
    protected $name = 'PFAPI_ERR_INTERNAL';

    /**
     * @var string
     */
    protected $message = 'Generic internal error';
}