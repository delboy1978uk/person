<?php

namespace Del\Person\Service;

use Del\Person\Criteria\PersonCriteria;
use Del\Person\Entity\Person;
use Del\Person\Repository\Person as PersonRepository;
use Doctrine\ORM\EntityManager;
use Pimple\Container;

class PersonService
{
    /** @var EntityManager $em */
    protected $em;

    public function __construct(Container $c)
    {
        $this->em = $c['doctrine.entity_manager'];
    }

   /** 
    * @param array $data
    * @return Person
    */
    public function createFromArray(array $data)
    {
        $person = new Person();
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
     * @param Person $person
     * @return array
     */
    public function toArray(Person $person)
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
     * @param Person $person
     * @return Person
     */
    public function savePerson(Person $person)
    {
        return $this->getRepository()->save($person);
    }

    /**
     * @param Person $person
     * @return Person
     */
    public function deletePerson(Person $person)
    {
        $this->getRepository()->delete($person);
    }

    /**
     * @param PersonCriteria $criteria
     * @return Person[]
     */
    public function findByCriteria(PersonCriteria $criteria)
    {
        return $this->getRepository()->findByCriteria($criteria);
    }

    /**
     * @param PersonCriteria $criteria
     * @return Person|null
     */
    public function findOneByCriteria(PersonCriteria $criteria)
    {
        $results = $this->findByCriteria($criteria);
        return (isset($results[0])) ? $results[0] : null;
    }

   /**
    * @return PersonRepository
    */
    protected function getRepository()
    {
        return $this->em->getRepository('Del\Person\Entity\Person');
    }
}
