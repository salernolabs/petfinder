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
     */
    public function testQuery()
    {
        $query = new \SalernoLabs\Petfinder\Requests\Shelter\ListByBreed($this->configuration);

        $data = $query
            ->setId('NY1100')
            ->setAnimal('dog')
            ->setBreed('Siberian Husky')
            ->execute();

        $this->assertNotEmpty($data);
    }
}