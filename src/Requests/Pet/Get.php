<?php
/**
 * Implements the pet.get API command
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Pet;

class Get extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'pet.get';

    use \SalernoLabs\Petfinder\Traits\RequestParameters\Id;

    /**
     * @var array
     */
    protected $requiredParameters = ['id'];

}