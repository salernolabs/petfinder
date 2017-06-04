<?php
/**
 * Petfinder Exception Record does not Exist
 *
 * @package Petfinder
 * @subpackage Exceptions
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Exceptions;

class RecordDoesNotExist extends Exception
{
    /**
     * @var int
     */
    protected $code = 201;

    /**
     * @var string
     */
    protected $name = 'PFAPI_ERR_NOENT';

    /**
     * @var string
     */
    protected $message = 'Record does not exist';
}