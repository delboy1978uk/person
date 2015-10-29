<?php

namespace Del\Repository;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

class Person
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
        $this->connection = $connection;
        $this->table = 'person';
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getDBALConnection()
    {
        return $this->connection;
    }

    /**
     * @param $id
     * @return null|Person
     */
    public function findById($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $query = $this->connection->prepare($sql);
        $query->bindValue('id', $id);
        $query->execute();

        $row = $query->fetch();
        return $row;
    }

    public function delete($id)
    {
        $this->connection->delete($this->table, ['id' => $id]);
    }

    /**
     * @param QueryBuilder $query
     * @param $limit
     * @param $offset
     * @return QueryBuilder
     */
    protected function setLimitAndOffset(QueryBuilder &$query, $limit, $offset = 0)
    {
        if ($offset > -1) {
            $query->setFirstResult($offset);
        }
        if ($limit) {
            $query->setMaxResults($limit);
        }
        return $query;
    }

}
