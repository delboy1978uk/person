<?php

namespace Del\Repository;

use Del\Entity\Person as PersonEntity;
use Doctrine\ORM\EntityRepository;

class Person extends EntityRepository
{
    /**
     * @param PersonEntity $person
     * @return PersonEntity
     */
    public function save(PersonEntity $person)
    {
        $this->_em->persist($person);
        $this->_em->flush();
        return $person;
    }
    /**
     * @param PersonEntity $person
     */
    public function delete(PersonEntity $person)
    {
        $this->_em->remove($person);
        $this->_em->flush();
    }
}
