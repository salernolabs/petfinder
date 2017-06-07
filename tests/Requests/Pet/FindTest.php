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
     * @dataProvider queryDataProvider
     */
    public function testQuery($age, $animal, $zip)
    {
        $query = new \SalernoLabs\Petfinder\Requests\Pet\Find($this->configuration);

        $data = $query
            ->setAge($age)
            ->setAnimal($animal)
            ->setLocation($zip)
            ->setCount(10)
            ->execute();

        $this->assertInstanceOf('\SalernoLabs\Petfinder\Responses\PetList', $data);
        $this->assertNotEmpty($data->pets);
        $this->assertLessThanOrEqual(10, $data->count);
    }

    /**
     * @return array
     */
    public function queryDataProvider()
    {
        return [
            ['Young', 'bird', '10014'],
            ['Adult', 'cat', '90210'],
            ['Senior', 'dog', '45255']
        ];
    }
}