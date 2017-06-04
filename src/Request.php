<?php
/**
 * Petfinder Request Base Class
 *
 * @package Petfinder
 * @subpackage Request
 * @author Eric
 */
namespace SalernoLabs\Petfinder;

use SalernoLabs\Petfinder\Exceptions\Exception;

abstract class Request implements RequestInterface
{
    /**
     * Get parameter array
     *
     * @return []
     */
    public function getParameterArray()
    {
        return [];
    }

    /**
     * Execute the request
     *
     * @param Configuration $configuration
     * @return mixed
     * @throws Exception
     * @throws Exceptions\AuthenticationFailure
     * @throws Exceptions\InvalidLocation
     * @throws Exceptions\InvalidRequest
     * @throws Exceptions\LimitExceeded
     * @throws Exceptions\RecordDoesNotExist
     * @throws Exceptions\Unauthorized
     */
    public function execute(Configuration $configuration)
    {
        //Initialize guzzle
        $client = new \GuzzleHttp\Client();

        $commandParameters = $this->getParameterArray();
        $commandParameters['format'] = 'json';

        //Sign the request
        $commandParameters['key'] = $configuration->getKey();
        $commandParameterString = http_build_query($commandParameters);
        $commandParameters['sig'] = md5($configuration->getSecret() . $commandParameterString);

        $requestParameters = [
            'query' => $commandParameters
        ];

        //Make the request
        $result = $client->request('GET', $configuration->getEndPoint(), $requestParameters);

        //Validate the result
        if ($result->getStatusCode() != 200)
        {
            throw new Exceptions\Exception("Failed to make a successful request to petfinder api endpoint " . $configuration->getEndPoint() . " with error code " . $result->getStatusCode() . " and error " . $result->getReasonPhrase());
        }

        $data = json_decode($result->getBody());

        if (empty($data))
        {
            throw new Exceptions\Exception("Retrieved non-JSON content from petfinder api endpoint " . $configuration->getEndPoint());
        }

        if (empty($data->header->status->code))
        {
            throw new Exceptions\Exception("Unknown JSON formatted content returned from petfdiner api endpoint " . $configuration->getEndPoint());
        }

        if ($data->header->status->code != 100)
        {
            $this->handlePetfinderError($data->header->status->code, $data->header->status->message);
        }

        //All's fine, return the object
        return $data;
    }

    /**
     * Handle a petfinder error
     *
     * @param $code
     * @param $message
     * @throws Exception
     * @throws Exceptions\AuthenticationFailure
     * @throws Exceptions\InvalidLocation
     * @throws Exceptions\InvalidRequest
     * @throws Exceptions\LimitExceeded
     * @throws Exceptions\RecordDoesNotExist
     * @throws Exceptions\Unauthorized
     */
    private function handlePetfinderError($code, $message)
    {
        switch ($code)
        {
            default:
            case 999: throw new Exceptions\Exception($message);
            case 200: throw new Exceptions\InvalidRequest($message);
            case 201: throw new Exceptions\RecordDoesNotExist($message);
            case 202: throw new Exceptions\LimitExceeded($message);
            case 203: throw new Exceptions\InvalidLocation($message);
            case 300: throw new Exceptions\Unauthorized($message);
            case 301: throw new Exceptions\AuthenticationFailure($message);
        }
    }
}