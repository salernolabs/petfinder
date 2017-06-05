<?php
/**
 * pet.getRandom test
 *
 * @package Petfinder
 * @subpackage Tests
 * @author Eric
 */
namespace SalernoLabs\Tests\Petfinder\Requests\Pet;

class GetRandomTest extends \PHPUnit\Framework\TestCase
{
    use \SalernoLabs\Tests\Petfinder\Traits\TestHelper;

    /**
     * Test the query
     *
     * @throws \SalernoLabs\Petfinder\Exceptions\Exception
     */
    public function testQuery()
    {
        $query = new \SalernoLabs\Petfinder\Requests\Pet\GetRandom($this->configuration);

        $data = $query
            ->setAnimal('bird')
            ->setLocation('10014')
            ->execute();

        $this->assertNotEmpty($data);
    }
}