<?php
/**
 * Implements the shelter.find API command
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Shelter;

class Find extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'shelter.find';

    use \SalernoLabs\Petfinder\Traits\RequestParameters\Location,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Pagination;

    /**
     * @var array
     */
    protected $requiredParameters = ['location'];

    /**
     * Set search name
     *
     * @param $name
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setName($name)
    {
        $name = trim(strip_tags($name));

        if (empty($name))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Please enter a valid name to search by.");
        }

        $this->requiredParameters = ['name'];

        $this->setParameterValue('name', $name);

        return $this;
    }

}