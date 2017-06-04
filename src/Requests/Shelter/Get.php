<?php
/**
 * Implements the shelter.get API command
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Shelter;

class Get extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'shelter.get';

    use \SalernoLabs\Petfinder\Traits\RequestParameters\Id;

    /**
     * @var array
     */
    protected $requiredParameters = ['id'];
}