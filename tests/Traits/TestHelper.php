<?php
/**
 * Test Helper
 *
 * @package Petfinder
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\Petfinder\Traits;

trait TestHelper
{
    /**
     * @var \SalernoLabs\Petfinder\Configuration
     */
    public $configuration;

    /**
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function setUp()
    {
        $key = getenv('PETFINDER_KEY');
        $secret = getenv('PETFINDER_SECRET');

        if (empty($key) || empty($secret))
        {
            die('To run tests, please specify environment variables PETFINDER_KEY and PETFINDER_SECRET.');
        }

        $this->configuration = new \SalernoLabs\Petfinder\Configuration();

        $this->configuration
            ->setKey($key, $secret);
    }

}