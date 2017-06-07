<?php
/**
 * shelter.get test
 *
 * @package Shelter
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\Petfinder\Requests\Shelter;

class GetTest extends \PHPUnit\Framework\TestCase
{
    use \SalernoLabs\Tests\Petfinder\Traits\TestHelper;

    /**
     * Test query
     *
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function testQuery()
    {
        $query = new \SalernoLabs\Petfinder\Requests\Shelter\Get($this->configuration);

        $data = $query
            ->setId('NY1100')
            ->execute();

        $this->assertInstanceOf('\SalernoLabs\Petfinder\Responses\Shelter', $data);
        $this->assertNotEmpty($data->id);
        $this->assertNotEmpty($data->country);
    }
}