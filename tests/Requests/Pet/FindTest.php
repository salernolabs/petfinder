<?php
/**
 * pet.find test
 *
 * @package Petfinder
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\Petfinder\Requests\Pet;

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
        $query = new \SalernoLabs\Petfinder\Requests\Pet\Find($this->configuration);

        $data = $query
            ->setAge('Young')
            ->setAnimal('bird')
            ->setLocation('10014')
            ->setCount(10)
            ->execute();

        $this->assertNotEmpty($data->pets);
        $this->assertEquals(10, $data->count);
    }
}