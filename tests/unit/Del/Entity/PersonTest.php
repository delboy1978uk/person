<?php

namespace Del\Entity;

use DateTime;
use Del\Factory\CountryFactory;

class PersonTest extends \Codeception\TestCase\Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var Person
     */
    protected $person;

    protected function _before()
    {
        // create a fresh blank class before each test
        $this->person = new Person();
    }

    protected function _after()
    {
        // unset the person class after each test
        unset($this->person);
    }

    public function testGetSetId()
    {
        $this->person->setId(100);
	    $this->assertEquals(100,$this->person->getId());
    }

    public function testGetSetCountry()
    {
        $country = CountryFactory::generate('GBR');
        $this->person->setCountry($country);
        $this->assertInstanceOf('Del\Entity\Country',$this->person->getCountry());
        $this->assertEquals('GBR',$this->person->getCountry()->getId());
    }

    public function testGetSetFirstname()
    {
        $this->person->setFirstname('Derek');
        $this->assertEquals('Derek',$this->person->getFirstname());
    }

    public function testGetSetMiddlename()
    {
        $this->person->setMiddlename('Stephen');
        $this->assertEquals('Stephen',$this->person->getMiddlename());
    }

    public function testGetSetLastname()
    {
        $this->person->setLastname('McLean');
        $this->assertEquals('McLean',$this->person->getLastname());
    }

    public function testGetSetAka()
    {
        $this->person->setAka('Delboy');
        $this->assertEquals('Delboy',$this->person->getAka());
    }

    public function testGetSetDob()
    {
        $this->person->setDob(new DateTime('1978-02-17'));
        $this->assertEquals('1978-02-17',$this->person->getDob()->format('Y-m-d'));
    }

    public function testGetSetBirthplace()
    {
        $this->person->setBirthplace('Glasgow');
        $this->assertEquals('Glasgow',$this->person->getBirthplace());
    }
}
