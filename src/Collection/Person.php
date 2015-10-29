<?php

namespace Del\Collection;

use Del\Entity\Person;

class Person extends ArrayIterator
{
    /**
     * @return Person
     */
    public function getFirstItem()
    {
        if ($this->count() === 0) {
            throw new LogicException('No items in schedule collection');
        }
        $this->rewind();
        return $this->current();
    }

    /**
     * @return Person
     */
    public function getLastItem()
    {
        if ($this->count() === 0) {
            throw new LogicException('No people in the collection');
        }
        $count = $this->count() - 1;
        return $this->offsetGet($count);
    }


    /**
     * @param Person $person
     * @return $this
     */
    public function update(Person $person)
    {
        $key = $this->findKey($person);
        if($key) {

            $this->offsetSet($key,$person);
            return $this;

        }
        throw new LogicException('Person was not in the collection.');
    }

    /**
     * @param Person $person
     */
    public function append(Person $person)
    {
        parent::append($person);
    }

    /**
     * @return Person|null
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * @param Person $person
     * @return bool|int
     */
    public function findKey(Person $person)
    {
        $this->rewind();
        /** @var OutboundPaymentScheduleEntity $installment */
        while($this->valid()) {
            if($this->current()->getId() == $person->getId()) {
                return $this->key();
            }
            $this->next();
        }
        return false;
    }

    /**
     * @return Person|null
     */
    public function prev()
    {
        if ($this->key() == 0) {
            return null;
        }
        $this->seek($this->key() - 1);
        return $this->current();
    }

}
