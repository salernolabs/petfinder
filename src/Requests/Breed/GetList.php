<?php
/**
 * Implements the breed.list API command,
 *
 * @note the class name is GetList which does not match the API command because List is a special keyword in php for the class name
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Breed;

class GetList extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'breed.list';

    use \SalernoLabs\Petfinder\Traits\RequestParameters\Animal;

    /**
     * @var array
     */
    protected $requiredParameters = ['animal'];
}