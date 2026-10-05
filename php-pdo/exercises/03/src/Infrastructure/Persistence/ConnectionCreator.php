<?php

namespace Pratica03Pdo\Src\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function CreateConnection(): PDO
    {
        $absoluteDatabasePath = __DIR__ . '/../../../database.sqlite';

        return new PDO('sqlite:' . $absoluteDatabasePath);
    }
}
