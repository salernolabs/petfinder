<?php
/**
 * shelter.find test
 *
 * @package Petfinder
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\Petfinder\Requests\Shelter;

class FindTest extends \PHPUnit\Framework\TestCase
{
    use \SalernoLabs\Tests\Petfinder\Traits\TestHelper;

    /**
     * Test the query
     *
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function testQuery()
    {
        $query = new \SalernoLabs\Petfinder\Requests\Shelter\Find($this->configuration);

        $data = $query
            ->setLocation('10014')
            ->setCount(10)
            ->execute();

        $this->assertInstanceOf('\SalernoLabs\Petfinder\Responses\ShelterList', $data);
        $this->assertNotEmpty($data->shelters);
        $this->assertEquals(10, $data->count);
        $this->assertNotEmpty($data->shelters[0]->id);
    }
}