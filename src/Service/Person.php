<?php

namespace Del\Service;

use Del\Entity\Person as PersonEntity;
use Del\Repository\Person as PersonRepository;
use Doctrine\ORM\EntityManager;
use Pimple\Container;

class Person
{
    /** @var EntityManager $em */
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

   /** 
    * @param array $data
    * @return PersonEntity
    */
    public function createFromArray(array $data)
    {
        $person = new PersonEntity();
        isset($data['id']) ? $person->setId($data['id']) : null;
        isset($data['firstname']) ? $person->setFirstname($data['firstname']) : null;
        isset($data['middlename']) ? $person->setMiddlename($data['middlename']) : null;
        isset($data['lastname']) ? $person->setLastname($data['lastname']) : null;
        isset($data['aka']) ? $person->setAka($data['aka']) : null;
        isset($data['dob']) ? $person->setDob($data['dob']) : null;
        isset($data['birthplace']) ? $person->setBirthplace($data['birthplace']) : null;
        isset($data['country']) ? $person->setCountry($data['country']) : null;
        return $person;
    }

    /**
     * @param array $person
     * @return PersonEntity
     */
    public function toArray(PersonEntity $person)
    {
        $data = [
            'id' => $person->getId(),
            'firstname' => $person->getFirstname(),
            'middlename' => $person->getMiddlename(),
            'lastname' => $person->getLastname(),
            'aka' => $person->getAka(),
            'dob' => $person->getDob(),
            'birthplace' => $person->getBirthplace(),
            'country' => $person->getCountry(),
        ];
        return $data;
    }

    /**
     * @param PersonEntity $person
     * @return PersonEntity
     */
    public function savePerson(PersonEntity $person)
    {
        return $this->getRepository()->save($person);
    }

   /**
    * @return PersonRepository
    */
    protected function getRepository()
    {
        return $this->em->getRepository('Del\Entity\Person');
    }
}
