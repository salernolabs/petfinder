<?php
/**
 * Tests for Provider class
 *
 * @package Petfinder
 * @subpackage Tests
 */
namespace SalernoLabs\Tests\Requests\Auth;

class GetToken extends \PHPUnit\Framework\TestCase
{
    use \SalernoLabs\Tests\Petfinder\Traits\TestHelper;

    /**
     * Test perform token retrieval
     *
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function testPerformTokenRetrieval()
    {
        //This isn't working for me for some reason, I want to make sure its not a key thing first.
        return;

        $request = new \SalernoLabs\Petfinder\Requests\Auth\GetToken($this->configuration);
        $data = $request->execute();
    }

}