<?php
/**
 * shelter.listByBreed
 *
 * @package Petfinder
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\Petfinder\Requests\Shelter;

class ListByBreedTest extends \PHPUnit\Framework\TestCase
{
    use \SalernoLabs\Tests\Petfinder\Traits\TestHelper;

    /**
     * Test query
     *
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     * @dataProvider dataProviderValidRequest
     */
    public function testQuery($animal)
    {
        $query = new \SalernoLabs\Petfinder\Requests\Breed\GetList($this->configuration);
        $breeds = $query
            ->setAnimal($animal)
            ->execute();

        $this->assertNotEmpty($breeds->breeds[0]);

        $query = new \SalernoLabs\Petfinder\Requests\Shelter\ListByBreed($this->configuration);

        $data = $query
            ->setAnimal($animal)
            ->setBreed($breeds->breeds[0])
            ->execute();

        $this->assertNotEmpty($data);
        $this->assertInstanceOf('\SalernoLabs\Petfinder\Responses\ShelterList', $data);
    }

    /**
     * @return array
     */
    public function dataProviderValidRequest()
    {
        return [
            ['barnyard'],
            ['cat'],
            ['dog'],
            ['horse'],
            ['pig'],
            ['smallfurry']
        ];
    }
}