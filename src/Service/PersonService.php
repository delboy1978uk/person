<?php

namespace Del\Person\Service;

use Del\Person\Criteria\PersonCriteria;
use Del\Person\Entity\Person;
use Del\Person\Repository\PersonRepository;
use Doctrine\ORM\EntityManager;
use Barnacle\Container;

class PersonService
{
    public function __construct(
        protected EntityManager $em
    ) {
    }

    public function createFromArray(array $data): Person
    {
        $person = new Person();

        return $this->populateFromArray($person, $data);
    }

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
        isset($data['backgroundImage']) ? $person->setImage($data['image']) : null;

        return $person;
    }

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
            'backgroundImage' => $person->getBackgroundImage(),
        ];

        return $data;
    }

    public function savePerson(Person $person): Person
    {
        return $this->getRepository()->save($person);
    }

    public function deletePerson(Person $person): void
    {
        $this->getRepository()->delete($person);
    }

    public function findByCriteria(PersonCriteria $criteria): array
    {
        return $this->getRepository()->findByCriteria($criteria);
    }

    public function findOneByCriteria(PersonCriteria $criteria): ?Person
    {
        $results = $this->findByCriteria($criteria);
        return (isset($results[0])) ? $results[0] : null;
    }

    protected function getRepository(): PersonRepository
    {
        return $this->em->getRepository(Person::class);
    }
}
