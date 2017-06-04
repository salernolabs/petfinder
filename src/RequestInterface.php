<?php
/**
 * Petfinder Request Interface
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder;

interface RequestInterface
{
    /**
     * Return an array that has the parameters for the query string to send as key=>value
     *
     * @return []
     */
    public function getParameterArray();

    /**
     * Execute the request
     *
     * @param Configuration $configuration
     * @param RequestInterface $request
     * @return mixed
     */
    public function execute(Configuration $configuration);
}