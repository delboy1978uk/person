<?php

namespace Del\Repository;

use Codeception\TestCase\Test;
use Del\Collection\Person as People;
use Del\Entity\Person;

class PersonPeopleTest extends Test
{
   /**
    * @var \UnitTester
    */
    protected $tester;

    /**
     * @var People
     */
    protected $people;

    protected function _before()
    {
        $this->people = new People();
    }

    protected function _after()
    {
        unset($this->people);
    }

    public function testGetFirstItem()
    {
        $payment = $this->getInboundPayment('testGetFirstItem');
        $payment = $this->svc->createInboundPayment($payment);
        $payment = $this->svc->createNewInboundSchedule($payment);
        $this->assertEquals('15/09/2015',$payment->getPaymentSchedule()->getFirstItem()->getDueDate()->format('d/m/Y'));
        $this->svc->deleteInboundPayment($payment);
    }

    public function testGetLastItem()
    {
        $payment = $this->getInboundPayment('testGetLastItem');
        $payment = $this->svc->createInboundPayment($payment);
        $payment = $this->svc->createNewInboundSchedule($payment);
        $this->assertEquals('17/11/2015',$payment->getPaymentSchedule()->getLastItem()->getDueDate()->format('d/m/Y'));
        $this->svc->deleteInboundPayment($payment);
    }


    public function testFindKeyReturnsFalseWhenNotInPeople()
    {
        $collection = new People();
        $person = new Person();
        $person->setId(1);
        $collection->append($person);
        $person = new Person();
        $person->setId(2);
        $collection->append($person);
        $person = new Person();
        $person->setId(3);
        $this->assertFalse($collection->findKey($person));
    }

    public function testFindByIdReturnsFalse()
    {
        $collection = new People();
        $person = new Person();
        $person->setId(1);
        $collection->append($person);
        $person = new Person();
        $person->setId(2);

        $this->assertFalse($collection->findById(911));
    }

    public function testUpdate()
    {
        $collection = new People();
        $person = new Person();
        $person->setId(1);
        $collection->append($person);
        $person = new Person();
        $person->setId(2);
        $collection->append($person);
        $person = new Person();
        $person->setId(3);
        $collection->append($person);
        $collection->rewind();
        $collection->next();
        $person = $collection->current(); //id 2
        $person->setFirstname('Theodoric');
        $collection->update($person);
        $this->assertEquals('Theodoric',$collection[1]->getFirstname());
    }

}
