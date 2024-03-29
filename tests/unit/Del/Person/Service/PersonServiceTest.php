<?php

namespace DelTesting\Repository;

use Codeception\Test\Unit;
use DateTime;
use Del\Factory\CountryFactory;
use Del\Person\Criteria\PersonCriteria;
use Del\Person\Entity\Person;
use Del\Person\PersonPackage;
use Del\Person\Repository\PersonRepository;
use Del\Person\Service\PersonService;
use DelTesting\ContainerProvider;
use Doctrine\ORM\EntityManager;

class PersonServiceTest extends Unit
{
    private PersonService $svc;

    protected function _before()
    {
        $person = new Person();
        $person->setId(6);
        $container =  ContainerProvider::getContainer();
        $repo =  $this->makeEmpty(PersonRepository::class, [
            'save' => $person,
            'findByCriteria' => [$person],
        ]);
        $container[EntityManager::class] =  $this->makeEmpty(EntityManager::class, [
            'getRepository' => $repo
        ]);
        $package = new PersonPackage();
        $package->addToContainer($container);
        $this->assertEquals('vendor/delboy1978uk/person/src/Entity', $package->getEntityPath());
        $this->svc = $container[PersonService::class];
    }

    protected function _after()
    {
        unset($this->db);
    }

    public function testCreateFromArray()
    {
        $array = $this->getPersonArray();
        $person = $this->svc->createFromArray($array);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);
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
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);
        $this->assertTrue(is_numeric($person->getId()));

        $person->setAka('Pollito');
        $person = $this->svc->savePerson($person);
        $this->assertEquals('Pollito', $person->getAka());
        $this->svc->deletePerson($person);
    }


    public function testFindOneByCriteria()
    {
        $person = $this->svc->createFromArray([
            'firstname' => 'Derek',
            'middlename' => 'Stephen',
            'lastname' => 'McLean',
            'aka' => 'Delboy',
            'dob' => new DateTime('1978-02-17'),
            'birthplace' => 'Glasgow',
            'country' => CountryFactory::generate('GB'),
        ]);
        $this->svc->savePerson($person);

        $person = $this->svc->createFromArray([
            'firstname' => 'Another',
            'middlename' => 'Person',
            'lastname' => 'Added',
            'aka' => 'Nobody',
            'dob' => new DateTime('1979-03-18'),
            'birthplace' => 'Manchester',
            'country' => CountryFactory::generate('GB'),
        ]);
        $this->svc->savePerson($person);

        $person = $this->svc->createFromArray([
            'firstname' => 'Yet',
            'middlename' => 'Another',
            'lastname' => 'Person',
            'aka' => 'Someone',
            'dob' => new DateTime('1980-04-19'),
            'birthplace' => 'Kingston',
            'country' => CountryFactory::generate('JM'),
        ]);
        $person = $this->svc->savePerson($person);

        $criteria = new PersonCriteria();
        $criteria->setId($person->getId());
        $person = $this->svc->findOneByCriteria($criteria);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);

        $criteria = new PersonCriteria();
        $criteria->setFirstname('Derek');
        $person = $this->svc->findOneByCriteria($criteria);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);

        $criteria = new PersonCriteria();
        $criteria->setMiddlename('Person');
        $person = $this->svc->findOneByCriteria($criteria);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);

        $criteria = new PersonCriteria();
        $criteria->setLastname('McLean');
        $person = $this->svc->findOneByCriteria($criteria);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);

        $criteria = new PersonCriteria();
        $criteria->setAka('Someone');
        $person = $this->svc->findOneByCriteria($criteria);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);

        $criteria = new PersonCriteria();
        $criteria->setBirthplace('Glasgow');
        $person = $this->svc->findOneByCriteria($criteria);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);

        $this->svc->deletePerson($person);

        $criteria = new PersonCriteria();
        $criteria->setDob('1979-03-18');
        $person = $this->svc->findOneByCriteria($criteria);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);

        $this->svc->deletePerson($person);

        $criteria = new PersonCriteria();
        $criteria->setCountry('JM');
        $person = $this->svc->findOneByCriteria($criteria);
        $this->assertInstanceOf('Del\Person\Entity\Person', $person);

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
            'country' => CountryFactory::generate('GB'),
        ];
    }

}
