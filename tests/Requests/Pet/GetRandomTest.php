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
     * @dataProvider dataProvider
     */
    public function testQuery($animal, $zip)
    {
        $query = new \SalernoLabs\Petfinder\Requests\Pet\GetRandom($this->configuration);

        $data = $query
            ->setAnimal($animal)
            ->setLocation($zip)
            ->setOutputType('full')
            ->execute();

        $this->assertInstanceOf('\SalernoLabs\Petfinder\Responses\Pet', $data);
        $this->assertNotEmpty($data);
    }

    /**
     * Data provider for queries
     */
    public function dataProvider()
    {
        return [
            ['bird', '10014'],
            ['dog', '42410'],
            ['cat', '90210']
        ];
    }
}