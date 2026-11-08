<?php

namespace Pratica06Pdo\Infrastructure\Persistence;
use PDO;

class ConnectionCreator {
    public static function CreateConnection(): PDO{
        $absoluteDatabasePath = __DIR__ . '../../../../banco.sqlite';
        return new PDO('sqlite:' . $absoluteDatabasePath);
    }
}