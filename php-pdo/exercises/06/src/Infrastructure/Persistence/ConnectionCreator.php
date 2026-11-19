<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function CreateConnection(): PDO
    {
        $connection = new PDO('sqlite:' . __DIR__ . '../../../../database.sqlite');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $connection;
    }
}