<?php

namespace DelTesting\Entity;

use Codeception\Test\Unit;
use DateTime;
use Del\Factory\CountryFactory;
use Del\Person\Entity\Person;

class PersonTest extends Unit
{
    private Person $person;

    protected function _before()
    {
        $this->person = new Person();
        $this->person->setId(123);
        $country = CountryFactory::generate('BE');
        $this->person->setCountry($country);
    }

    protected function _after()
    {
        unset($this->person);
    }

    public function testGetSetId()
    {
        $this->person->setId(100);
        $this->assertEquals(100, $this->person->getId());
    }

    public function testGetSetCountry()
    {
        $country = CountryFactory::generate('GB');
        $this->person->setCountry($country);
        $this->assertInstanceOf('Del\Entity\Country', $this->person->getCountry());
        $this->assertEquals('GBR', $this->person->getCountry()->getId());
    }

    public function testGetSetFirstname()
    {
        $this->person->setFirstname('Derek');
        $this->assertEquals('Derek', $this->person->getFirstname());
    }

    public function testGetSetMiddlename()
    {
        $this->person->setMiddlename('Stephen');
        $this->assertEquals('Stephen', $this->person->getMiddlename());
    }

    public function testGetSetLastname()
    {
        $this->person->setLastname('McLean');
        $this->assertEquals('McLean', $this->person->getLastname());
    }

    public function testGetSetAka()
    {
        $this->person->setAka('Delboy');
        $this->assertEquals('Delboy', $this->person->getAka());
    }

    public function testGetSetDob()
    {
        $this->person->setDob(new DateTime('1978-02-17'));
        $this->assertEquals('1978-02-17', $this->person->getDob()->format('Y-m-d'));
    }

    public function testGetSetBirthplace()
    {
        $this->person->setBirthplace('Glasgow');
        $this->assertEquals('Glasgow', $this->person->getBirthplace());
    }

    public function testGetSetImage()
    {
        $this->person->setImage('photo.jpg');
        $this->assertEquals('photo.jpg', $this->person->getImage());
    }

    public function testGetSetBackgroundImage()
    {
        $this->person->setBackgroundImage('photo.jpg');
        $this->assertEquals('photo.jpg', $this->person->getBackgroundImage());
    }

    public function testGetFullName()
    {
        $this->person->setFirstname('Robert');
        $this->person->setMiddlename('Louis');
        $this->person->setLastname('Stevenson');
        $this->assertEquals('Robert Louis Stevenson', $this->person->getFullName(true));
    }

    public function testJsonSerialize()
    {
        $json = \json_encode($this->person);
        $this->assertEquals('{"id":123,"firstname":"","middlename":"","lastname":"","aka":"","dob":null,"birthplace":"","country":"BE","image":"","backgrundImage":""}', $json);
        $this->assertCount(10, json_decode($json, true));
    }
}
