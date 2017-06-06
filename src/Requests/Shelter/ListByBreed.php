<?php
/**
 * Implements the shelter.listByBreed API command
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Shelter;

class ListByBreed extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'shelter.listByBreed';
    const PETFINDER_REQUEST_TYPE = 'GET';

    use \SalernoLabs\Petfinder\Traits\RequestParameters\ShelterId,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Animal,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Breed,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Pagination;

    /**
     * @var array
     */
    protected $requiredParameters = ['id', 'animal', 'breed'];
}