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
    const PETFINDER_REQUEST_TYPE = 'GET';

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

        $result = $this->makeAPIRequest();

        $data = json_decode($result);

        if (empty($data))
        {
            throw new Exceptions\Exception("Retrieved non-JSON content from petfinder api endpoint " . $this->configuration->getEndPoint() . static::PETFINDER_COMMAND);
        }

        if (empty($data->petfinder) || empty($data->petfinder->header->status->code->{'$t'}))
        {
            throw new Exceptions\Exception("Unknown JSON formatted content returned from petfinder api endpoint " . $this->configuration->getEndPoint() . static::PETFINDER_COMMAND);
        }

        if ($data->petfinder->header->status->code->{'$t'} != 100)
        {
            $this->handlePetfinderError($data->petfinder->header->status->code->{'$t'}, $data->petfinder->header->status->message);
        }

        //All's fine, return the processed object
        $processed = $this->processResult($data);

        return $processed;
    }

    /**
     * Return processed results
     *
     * @param $data
     * @return Responses\BreedList
     */
    private function processResult($data)
    {
        if (!empty($data->petfinder->breeds->breed))
        {
            return new \SalernoLabs\Petfinder\Responses\BreedList($data);
        }
        else if (!empty($data->petfinder->pets->pet))
        {
            return new \SalernoLabs\Petfinder\Responses\PetList($data);
        }
        else if (!empty($data->petfinder->pet))
        {
            return new \SalernoLabs\Petfinder\Responses\Pet($data->petfinder->pet);
        }
        else if (!empty($data->petfinder->petIds->id))
        {
            $array = [];
            if (is_array($data->petfinder->petIds->id))
            {
                foreach ($data->petfinder->petIds->id as $id)
                {
                    $array[] = $id->{'$t'};
                }
            }
            else
            {
                $array[] = $data->petfinder->petIds->id->{'$t'};
            }

            return $array;
        }
        else if (!empty($data->petfinder->shelters->shelter))
        {
            return new \SalernoLabs\Petfinder\Responses\ShelterList($data);
        }
        else if (!empty($data->petfinder->shelter))
        {
            return new \SalernoLabs\Petfinder\Responses\Shelter($data->petfinder->shelter);
        }

        return $data->petfinder;
    }


    /**
     * Make Guzzle Request
     *
     * @return string
     */
    private function makeAPIRequest()
    {
        if ($this->configuration->getTestMode())
        {
            $result = $this->checkForCachedTestCopy();
            if (!empty($result))
            {
                return $result;
            }
        }

        //Initialize guzzle
        $client = new \GuzzleHttp\Client(
            [
                'base_uri' => $this->configuration->getEndPoint()
            ]
        );

        $commandParameters = array_merge(
            [
                'format'=>'json',
                'key'=>$this->configuration->getKey()
            ],
            $this->parameters
        );

        //Sign the request
        $commandParameterString = '';
        foreach ($commandParameters as $field => $value)
        {
            if (!empty($commandParameterString)) $commandParameterString .= '&';

            $commandParameterString .= $field . '=' . urlencode($value);
        }

        $commandParameters['sig'] = md5($this->configuration->getSecret() . $commandParameterString);

        $requestParameters = [];
        if (static::PETFINDER_REQUEST_TYPE == 'POST')
        {
            $commandParameterString .= '&sig=' . $commandParameters['sig'];

            $requestParameters = [
                'body' => $commandParameterString,
            ];
        }
        else if (static::PETFINDER_REQUEST_TYPE == "GET")
        {
            $requestParameters = [
                'query' => $commandParameters,
            ];
        }

        //Make the request
        $result = $client->request(static::PETFINDER_REQUEST_TYPE, '/' . static::PETFINDER_COMMAND, $requestParameters);

        //Validate the result
        if (empty($result) || $result->getStatusCode() != 200)
        {
            throw new Exceptions\Exception("Failed to make a successful request to petfinder api endpoint " . $this->configuration->getEndPoint() . static::PETFINDER_COMMAND . " with error code " . $result->getStatusCode() . " and error " . $result->getReasonPhrase());
        }

        $body = $result->getBody();

        if ($this->configuration->getTestMode())
        {
            $this->saveCachedTestCopy($body);
        }

        return $body;
    }

    /**
     * Check for a cached test copy
     */
    private function checkForCachedTestCopy()
    {
        $cacheKey = $this->getCachedTestKey();

        $filename = getcwd() . '/tests/data/' . $cacheKey . '.txt';
        if (file_exists($filename))
        {
            return base64_decode(file_get_contents($filename));
        }

        return false;
    }

    /**
     * Save cached copy
     *
     * @param $data
     */
    private function saveCachedTestCopy($data)
    {
        $cacheKey = $this->getCachedTestKey();

        $filename = getcwd() . '/tests/data/' . $cacheKey . '.txt';

        //We'll base64_encode this so we don't provide raw feed content to search engine perusal
        file_put_contents($filename, base64_encode($data));
    }

    /**
     * Get cache key
     *
     * @return string
     */
    private function getCachedTestKey()
    {
        return static::PETFINDER_COMMAND . '-' . str_replace(['&','='], '-', http_build_query($this->parameters));
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
        if (empty($message))
        {
            $message = null;
        }

        if (!empty($message->{'$t'}))
        {
            $message = $message->{'$t'};
        }

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