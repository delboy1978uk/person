<?php

namespace Del\Repository;

use Codeception\TestCase\Test;
use Del\Service\Person as PersonService;
use DelTesting\DelTesting;

class PersonServiceest extends Test
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
        $container = DelTesting::getContainer();
        $this->svc = new PersonService($container);
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
        $this->assertEquals('GBR', $person->getCountry());
    }

    public function testGetRepository()
    {
        $db = $this->svc->getRepository();
        $this->assertInstanceOf('Del\Repository\Person', $db);
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
            'dob' => '1978-02-17',
            'birthplace' => 'Glasgow',
            'country' => 'GBR',
        ];
    }

}
