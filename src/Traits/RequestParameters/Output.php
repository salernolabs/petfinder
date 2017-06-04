<?php
/**
 * Adds a function to handle and validate output types in request objects
 *
 * @package Petfinder
 * @subpackage Traits
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Traits\RequestParameters;

trait Output
{
    /**
     * Set output type
     *
     * @param $outputType
     * @return $this
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setOutputType($outputType)
    {
        $validOutputTypes = ['basic' => 1, 'full' => 1];

        if (empty($validOutputTypes[$outputType]))
        {
            throw new \SalernoLabs\Petfinder\Exceptions\Exception("Invalid output type specified, please use any of the following " . implode(', ' , $validOutputTypes));
        }

        $this->setParameterValue('output', $outputType);

        return $this;
    }
}