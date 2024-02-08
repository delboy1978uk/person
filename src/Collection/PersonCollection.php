<?php

declare(strict_types=1);

namespace Del\Person\Collection;

use Del\Person\Entity\Person as PersonEntity;
use Doctrine\Common\Collections\ArrayCollection;
use LogicException;

class PersonCollection extends ArrayCollection
{

    public function update(PersonEntity $person): void
    {
        $key = $this->findKey($person);

        if($key) {
            $this->offsetSet($key,$person);

            return;
        }

        throw new LogicException('Person was not in the collection.');
    }

    public function append(PersonEntity $person)
    {
        $this->add($person);
    }

    public function current(): ?PersonEntity
    {
        return parent::current();
    }

    public function findKey(PersonEntity $person): int|bool
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

    public function findById($id): PersonEntity|bool
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
