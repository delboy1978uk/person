<?php

namespace DelTesting\Entity;

use Codeception\TestCase\Test;
use Del\Person\Criteria\PersonCriteria;

class PersonCriteriaTest extends Test
{
    public function testGetSet()
    {
        $criteria = new PersonCriteria();
        $criteria->setId(6);
        $criteria->setOffset(5);
        $criteria->setLimit(5);
        $criteria->setBirthplace('Glasgow');
        $criteria->setFirstname('Derek');
        $criteria->setMiddlename('Stephen');
        $criteria->setLastname('McLean');
        $criteria->setAka('Del');
        $criteria->setCountry('Scotland');
        $criteria->setDob('1978-02-17');
        $criteria->setOrder(PersonCriteria::ORDER_BIRTHPLACE);
        $criteria->setOrderDirection(PersonCriteria::ORDER_ASC);
        $criteria->setPagination(2, 5);

        $this->assertTrue($criteria->hasId());
        $this->assertTrue($criteria->hasOffset());
        $this->assertTrue($criteria->hasLimit());
        $this->assertTrue($criteria->hasOrder());
        $this->assertTrue($criteria->hasOrderDirection());
        $this->assertTrue($criteria->hasBirthplace());
        $this->assertTrue($criteria->hasFirstname());
        $this->assertTrue($criteria->hasMiddlename());
        $this->assertTrue($criteria->hasLastname());
        $this->assertTrue($criteria->hasLastname());
        $this->assertTrue($criteria->hasAka());
        $this->assertTrue($criteria->hasCountry());
        $this->assertTrue($criteria->hasDob());

        $this->assertEquals(6, $criteria->getId());
        $this->assertEquals(5, $criteria->getOffset());
        $this->assertEquals(5, $criteria->getLimit());
        $this->assertEquals(PersonCriteria::ORDER_BIRTHPLACE, $criteria->getOrder());
        $this->assertEquals(PersonCriteria::ORDER_ASC, $criteria->getOrderDirection());
        $this->assertEquals('Glasgow', $criteria->getBirthplace());
        $this->assertEquals('Derek', $criteria->getFirstname());
        $this->assertEquals('Stephen', $criteria->getMiddlename());
        $this->assertEquals('McLean', $criteria->getLastname());
        $this->assertEquals('Del', $criteria->getAka());
        $this->assertEquals('Glasgow', $criteria->getBirthplace());
        $this->assertEquals('Scotland', $criteria->getCountry());
        $this->assertEquals('1978-02-17', $criteria->getDob());
    }
}
