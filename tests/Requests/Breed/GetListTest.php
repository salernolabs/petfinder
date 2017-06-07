<?php
/**
 * Test breed.list
 *
 * @package Petfinder
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\Petfinder\Requests\Breed;

class GetListTest extends \PHPUnit\Framework\TestCase
{
    use \SalernoLabs\Tests\Petfinder\Traits\TestHelper;

    /**
     * @param $animalType
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     * @dataProvider dataProviderValidRequest
     */
    public function testValidRequest($animalType)
    {
        $request = new \SalernoLabs\Petfinder\Requests\Breed\GetList($this->configuration);
        $data = $request
                    ->setAnimal($animalType)
                    ->execute();

        $this->assertInstanceOf('\SalernoLabs\Petfinder\Responses\BreedList', $data);
        $this->assertNotEmpty($data->breeds);
        $this->assertEquals($animalType, $data->animal);
    }

    /**
     * @return array
     */
    public function dataProviderValidRequest()
    {
        return [
            ['barnyard'],
            ['bird'],
            ['cat'],
            ['dog'],
            ['horse'],
            ['pig'],
            ['reptile'],
            ['smallfurry']
        ];
    }
}