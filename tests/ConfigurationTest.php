<?php
/**
 * Tests for Provider class
 *
 * @package Petfinder
 * @subpackage Tests
 */
namespace SalernoLabs\Tests\Petfinder;

class ConfigurationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $endPoint
     * @param $key
     * @param $secret
     * @param $token
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     * @dataProvider dataProviderGettersAndSetters
     */
    public function testConfigurationGettersAndSetters($endPoint, $key, $secret, $token)
    {
        $configuration = new \SalernoLabs\Petfinder\Configuration();

        $configuration
            ->setEndPoint($endPoint)
            ->setKey($key, $secret)
            ->setToken($token);

        $this->assertEquals($endPoint, $configuration->getEndPoint());
        $this->assertEquals($key, $configuration->getKey());
        $this->assertEquals($secret, $configuration->getSecret());
        $this->assertEquals($token, $configuration->getToken());
    }

    /**
     * @return array
     */
    public function dataProviderGettersAndSetters()
    {
        return [
            ['https://www.some.url/', 'testKey', 'testSecret', 'testToken'],
            ['http://thing/', '87fasd87asfd', '2341234 !@$? !@#$? ', 'false'],
            ['http://thing.site/', 'testKey', 'testSecret', 'testToken'],
        ];
    }
}