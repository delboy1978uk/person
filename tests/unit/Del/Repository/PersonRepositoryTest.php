<?php

namespace Del\Repository;

use Codeception\TestCase\Test;
use DateTime;
use Del\Entity\Person as PersonEntity;
use Del\Service\Person as PersonService;
use DelTesting\DelTesting;

class PersonRepositoryTest extends Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Person
     */
    protected $db;

    protected function _before()
    {
        $container = DelTesting::getContainer();
        $svc = new PersonService($container);
        $this->db = $svc->getRepository();
    }

    protected function _after()
    {
        unset($this->db);
    }

    public function testPersistAndRetrievePerson()
    {
        $person = new PersonEntity();
        $person->setFirstname('Derek');
        $person->setMiddlename('Stephen');
        $person->setLastname('McLean');
        $person->setAka('Delboy');
        $person->setDob(new DateTime('1978-02-17'));
        $person->setBirthplace('Glasgow');
        $person->setCountry('GBR');

        /** @var PersonEntity $person */
        $person = $this->db->save($person);
        $id = $person->getId();
        $person = $this->db->findById($id);

        $this->assertEquals($id,$person->getId());
        $this->assertEquals('Derek',$person->getFirstname());
        $this->assertEquals('Stephen',$person->getMiddlename());
        $this->assertEquals('McLean',$person->getLastname());
        $this->assertEquals('Delboy',$person->getAka());
        $this->assertEquals('1978-02-17',$person->getDob()->format('Y-m-d'));
        $this->assertEquals('Glasgow',$person->getBirthplace());
        $this->assertEquals('GBR',$person->getCountry());

        $this->db->delete($id);

        $this->setExpectedException('Exception');
        $this->db->findById($id);
    }

}
