<?php

namespace DelTesting\Repository;

use Codeception\TestCase\Test;
use Del\Person\Collection\PersonCollection as People;
use Del\Person\Entity\Person;

class PersonCollectionTest extends Test
{
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

    public function testFindById()
    {
        $collection = new People();
        $person = new Person();
        $person->setId(1);
        $collection->append($person);
        $person = new Person();
        $person->setId(2);
        $collection->append($person);

        $person = $collection->findById(2);
        $this->assertInstanceOf('Del\Person\Entity\Person',$person);
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
        $collection->first();
        $collection->next();
        $person = $collection->current(); //id 2
        $person->setFirstname('Theodoric');
        $collection->update($person);
        $this->assertEquals('Theodoric',$collection[1]->getFirstname());
        $person = new Person();
        $person->setId(4);
        $this->expectException('LogicException');
        $collection->update($person);
    }

}
