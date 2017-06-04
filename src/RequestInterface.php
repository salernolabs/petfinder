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
     * Execute the request
     *
     * @return mixed
     */
    public function execute();
}