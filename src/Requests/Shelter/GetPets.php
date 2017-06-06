<?php
/**
 * Implements the shelter.getPets API command
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Shelter;

class GetPets extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'shelter.getPets';

    use \SalernoLabs\Petfinder\Traits\RequestParameters\ShelterId,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Pagination,
        \SalernoLabs\Petfinder\Traits\RequestParameters\Output;

    /**
     * @var array
     */
    protected $requiredParameters = ['id'];

    /**
     * Set status
     *
     * @param $status
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setStatus($status)
    {
        $validStatuses = ['A'=>1, 'H'=>1, 'P'=>1, 'X'=>1];

        if (empty($validStatuses[$status]))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Invalid status type specified. Please use one of the following " . implode(', ' , $validStatuses));
        }

        $this->setParameterValue('status', $status);

        return $this;
    }
}