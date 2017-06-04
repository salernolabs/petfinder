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
    const PETFINDER_COMMAND = '';

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * @var array
     */
    protected $requiredParameters = [];

    /**
     * Request constructor.
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Set parameter values
     *
     * @param $key
     * @param $value
     */
    protected function setParameterValue($key, $value)
    {
        $this->parameters[$key] = urlencode($value);
    }

    /**
     * Validate requirement parameters are present
     *
     * @throws Exception
     */
    private function validateRequiredParametersArePresent()
    {
        foreach ($this->requiredParameters as $field)
        {
            if (empty($this->parameters[$field]))
            {
                throw new Exceptions\Exception("Missing parameter for " . static::PETFINDER_COMMAND . " to function: " . $field);
            }
        }
    }

    /**
     * Execute the request
     *
     * @return mixed
     * @throws Exception
     * @throws Exceptions\AuthenticationFailure
     * @throws Exceptions\InvalidLocation
     * @throws Exceptions\InvalidRequest
     * @throws Exceptions\LimitExceeded
     * @throws Exceptions\RecordDoesNotExist
     * @throws Exceptions\Unauthorized
     */
    public function execute()
    {
        $this->validateRequiredParametersArePresent();

        //Initialize guzzle
        $client = new \GuzzleHttp\Client();

        $commandParameters = array_merge(
            [
                'format'=>'json',
                'key'=>$this->configuration->getKey()
            ],
            $this->parameters
        );

        //Sign the request
        $commandParameterString = http_build_query($commandParameters);
        $commandParameters['sig'] = md5($this->configuration->getSecret() . $commandParameterString);

        $commandParameterString .= '&sig=' . $commandParameters['sig'];

        $requestParameters = [
            'body' => $commandParameterString
        ];

        $endPoint = $this->configuration->getEndPoint() . static::PETFINDER_COMMAND;

        //Make the request
        $result = $client->request('POST', $endPoint, $requestParameters);

        //Validate the result
        if ($result->getStatusCode() != 200)
        {
            throw new Exceptions\Exception("Failed to make a successful request to petfinder api endpoint " . $endPoint . " with error code " . $result->getStatusCode() . " and error " . $result->getReasonPhrase());
        }

        $data = json_decode($result->getBody());

        if (empty($data))
        {
            die($result->getBody());
            throw new Exceptions\Exception("Retrieved non-JSON content from petfinder api endpoint " . $endPoint);
        }

        if (empty($data->header->status->code))
        {
            throw new Exceptions\Exception("Unknown JSON formatted content returned from petfinder api endpoint " . $endPoint);
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