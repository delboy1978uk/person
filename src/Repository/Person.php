<?php

namespace Del\Repository;

use Del\Entity\Person as PersonEntity;
use Doctrine\DBAL\Connection;
use Exception;

class Person extends RepositoryAbstract
{
    /** @var \Doctrine\DBAL\Connection */
    protected $connection;

    /** @var string $table */
    protected $table;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->table = 'person';
        parent::__construct($connection);
    }

    /**
     * @param $id
     * @return PersonEntity
     * @throws Exception
     */
    public function findById($id)
    {
        $row = parent::findById($id);

        if ($row === false) {
            throw new Exception('Could not find person');
        }

        $entity = new PersonEntity($row);

        return $entity;
    }

    /**
     * @param PersonEntity $person
     * @return PersonEntity
     */
    public function save(PersonEntity $person)
    {
        return parent::save($person);
    }
}
