<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function CreateConnection(): PDO
    {
        return new PDO('sqlite:' . __DIR__ . '../../../database.sqlite');
    }
}