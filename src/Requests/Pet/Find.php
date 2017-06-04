<?php
/**
 * Implements the pet.find API command
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Pet;

class Find extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'pet.find';

    use \SalernoLabs\Petfinder\Traits\RequestParameters\Animal,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Breed,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Size,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Sex,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Location,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Age,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Pagination,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Output;

    /**
     * @var array
     */
    protected $requiredParameters = ['location'];


}