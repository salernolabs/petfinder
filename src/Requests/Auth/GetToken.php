<?php
/**
 * Implements the auth.getToken API command
 *
 * @package Petfinder
 * @subpackage Requests
 * @author Eric
 */
namespace SalernoLabs\Petfinder\Requests\Auth;

class GetToken extends \SalernoLabs\Petfinder\Request
{
    const PETFINDER_COMMAND = 'auth.getToken';

    const PETFINDER_REQUEST_TYPE = 'POST';
}