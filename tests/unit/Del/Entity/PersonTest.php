<?php

namespace Del\Entity;

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

    /**
     * Check tests are working
     */
    public function testBlah()
    {
	    $this->assertEquals('Ready to start building tests',$this->person->blah());
    }


}
