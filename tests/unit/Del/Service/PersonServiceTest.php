<?php

namespace Del\Repository;

use Codeception\TestCase\Test;
use DateTime;
use Del\Factory\CountryFactory;
use Del\Service\Person as PersonService;
use Del\Common\ContainerService;
use Del\Common\DbCredentials;

class PersonServiceTest extends Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var PersonService
     */
    protected $svc;

    protected function _before()
    {
        $container = ContainerService::getInstance()
            ->getContainer();
        $this->svc = new PersonService($container['doctrine.entity_manager']);
    }

    protected function _after()
    {
        unset($this->db);
    }

    public function testCreateFromArray()
    {
        $array = $this->getPersonArray();
        $person = $this->svc->createFromArray($array);
        $this->assertInstanceOf('Del\Entity\Person', $person);
        $this->assertEquals('Derek', $person->getFirstname());
        $this->assertEquals('Stephen', $person->getMiddlename());
        $this->assertEquals('McLean', $person->getLastname());
        $this->assertEquals('Delboy', $person->getAka());
        $this->assertEquals('1978-02-17', $person->getDob()->format('Y-m-d'));
        $this->assertEquals('Glasgow', $person->getBirthplace());
        $this->assertEquals('GBR', $person->getCountry()->getId());
    }

    public function testToArray()
    {
        $array = $this->getPersonArray();
        $person = $this->svc->createFromArray($array);
        $array = $this->svc->toArray($person);

        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('firstname', $array);
        $this->assertArrayHasKey('middlename', $array);
        $this->assertArrayHasKey('lastname', $array);
        $this->assertArrayHasKey('aka', $array);
        $this->assertArrayHasKey('dob', $array);
        $this->assertArrayHasKey('birthplace', $array);
        $this->assertArrayHasKey('country', $array);
    }


    public function testSavePerson()
    {
        $person = $this->svc->createFromArray($this->getPersonArray());
        $person = $this->svc->savePerson($person);
        $this->assertInstanceOf('Del\Entity\Person', $person);
        $this->assertTrue(is_numeric($person->getId()));

        $person->setAka('Pollito');
        $person = $this->svc->savePerson($person);
        $this->assertEquals('Pollito', $person->getAka());
        $this->svc->deletePerson($person);
    }

    /**
     * @return array
     */
    private function getPersonArray()
    {
        return [
            'firstname' => 'Derek',
            'middlename' => 'Stephen',
            'lastname' => 'McLean',
            'aka' => 'Delboy',
            'dob' => new DateTime('1978-02-17'),
            'birthplace' => 'Glasgow',
            'country' => CountryFactory::generate('GBR'),
        ];
    }

}
