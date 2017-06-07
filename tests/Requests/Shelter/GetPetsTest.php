<?php
/**
 * shelter.getPets test
 * 
 * @package Petfinder
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\Petfinder\Requests\Shelter;

class GetPetsTest extends \PHPUnit\Framework\TestCase
{
    use \SalernoLabs\Tests\Petfinder\Traits\TestHelper;

    /**
     * Test the query
     *
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function testQuery()
    {
        $query = new \SalernoLabs\Petfinder\Requests\Shelter\GetPets($this->configuration);

        $data = $query
            ->setId('NY1100')
            ->setCount(10)
            ->execute();

        $this->assertInstanceOf('\SalernoLabs\Petfinder\Responses\PetList', $data);
        $this->assertNotEmpty($data);
    }
}