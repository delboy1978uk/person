<?php

namespace Del\Collection;

use ArrayIterator;
use Del\Entity\Person as PersonEntity;
use LogicException;

class Person extends ArrayIterator
{
    /**
     * @return PersonEntity
     */
    public function getFirstItem()
    {
        if ($this->count() === 0) {
            throw new LogicException('No people in the collection');
        }
        $this->rewind();
        return $this->current();
    }

    /**
     * @return PersonEntity
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
     * @param PersonEntity $person
     * @return $this
     */
    public function update(PersonEntity $person)
    {
        $key = $this->findKey($person);
        if($key) {

            $this->offsetSet($key,$person);
            return $this;

        }
        throw new LogicException('Person was not in the collection.');
    }

    /**
     * @param PersonEntity $person
     */
    public function append(PersonEntity $person)
    {
        parent::append($person);
    }

    /**
     * @return PersonEntity|null
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * @param PersonEntity $person
     * @return bool|int
     */
    public function findKey(PersonEntity $person)
    {
        $this->rewind();
        while($this->valid()) {
            if($this->current()->getId() == $person->getId()) {
                return $this->key();
            }
            $this->next();
        }
        return false;
    }

    /**
     * @return PersonEntity|null
     */
    public function prev()
    {
        if ($this->key() == 0) {
            return null;
        }
        $this->seek($this->key() - 1);
        return $this->current();
    }

    public function findById($id)
    {
        $this->rewind();
        
        while ($this->valid()) {
            if($this->current()->getId() == $id) {
                return $this->current();
            }
            $this->next();
        }

        return false;
    }

}