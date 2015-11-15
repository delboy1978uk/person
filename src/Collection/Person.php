<?php

namespace Del\Collection;

use Del\Entity\Person as PersonEntity;
use Doctrine\Common\Collections\ArrayCollection;
use LogicException;

class Person extends ArrayCollection
{
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
        parent::add($person);
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
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            if($it->current()->getId() == $person->getId()) {
                return $it->key();
            }
            $it->next();
        }
        return false;
    }



    public function findById($id)
    {
        $it = $this->getIterator();
        $it->rewind();
        while($it->valid()) {
            if($it->current()->getId() == $id) {
                return $it->current();
            }
            $it->next();
        }

        return false;
    }

}