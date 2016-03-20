<?php

namespace DelTesting\Driver;

use Doctrine\DBAL\Driver\PDOMySql\Driver;

class MySql extends Driver
{
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array())
    {
        static $connection;
        if (null === $connection) {
            $connection = parent::connect($params, $username, $password, $driverOptions);
        }

        return $connection;
    }
}