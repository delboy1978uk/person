<?php

namespace Del\Person\Service;

use Del\Person\Criteria\PersonCriteria;
use Del\Person\Entity\Person;
use Del\Person\Repository\PersonRepository;
use Doctrine\ORM\EntityManager;
use Barnacle\Container;

class PersonService
{
    /** @var EntityManager $em */
    protected $em;

    /**
     * PersonService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

   /** 
    * @param array $data
    * @return Person
    */
    public function createFromArray(array $data): Person
    {
        $person = new Person();

        return $this->populateFromArray($person, $data);
    }

    /**
     * @param Person $person
     * @param array $data
     * @return Person
     */
    public function populateFromArray(Person $person, array $data): Person
    {
        isset($data['id']) ? $person->setId($data['id']) : null;
        isset($data['firstname']) ? $person->setFirstname($data['firstname']) : null;
        isset($data['middlename']) ? $person->setMiddlename($data['middlename']) : null;
        isset($data['lastname']) ? $person->setLastname($data['lastname']) : null;
        isset($data['aka']) ? $person->setAka($data['aka']) : null;
        isset($data['dob']) ? $person->setDob($data['dob']) : null;
        isset($data['birthplace']) ? $person->setBirthplace($data['birthplace']) : null;
        isset($data['country']) ? $person->setCountry($data['country']) : null;
        isset($data['image']) ? $person->setImage($data['image']) : null;

        return $person;
    }

    /**
     * @param Person $person
     * @return array
     */
    public function toArray(Person $person): array
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
            'image' => $person->getImage(),
        ];
        return $data;
    }

    /**
     * @param Person $person
     * @return Person
     */
    public function savePerson(Person $person): Person
    {
        return $this->getRepository()->save($person);
    }

    /**
     * @param Person $person
     */
    public function deletePerson(Person $person): void
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
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    protected function getRepository()
    {
        return $this->em->getRepository(Person::class);
    }
}
