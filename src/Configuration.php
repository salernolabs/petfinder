<?php
/**
 * Petfinder Configuration Class
 *
 * @package Petfinder
 * @author Eric
 */
namespace SalernoLabs\Petfinder;

class Configuration
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $endPoint = 'https://api.petfinder.com/';

    /**
     * Set key
     *
     * @param $key
     * @param $secret
     * @return $this
     */
    public function setKey($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;

        if (empty($this->key) || empty($this->secret))
        {
            throw new Exceptions\Exception("A valid key and secret are required.");
        }

        return $this;
    }

    /**
     * Set endpoint
     *
     * @param $endPoint
     * @return $this
     * @throws \Exception
     */
    public function setEndPoint($endPoint)
    {
        $this->endPoint = $endPoint;

        if (!filter_var($endPoint, FILTER_VALIDATE_URL))
        {
            throw new Exceptions\Exception("Invalid end point specified: " . $endPoint);
        }

        return $this;
    }

    /**
     * Set auth token, retrieved from petfinder
     *
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        if (empty($this->token))
        {
            throw new Exceptions\Exception("A valid token is required.");
        }

        return $this;
    }

    /**
     * Get endPoint
     *
     * @return string
     */
    public function getEndPoint()
    {
        return $this->endPoint;
    }

    /**
     * Get key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get secret
     *
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

}