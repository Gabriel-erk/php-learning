<?php 

namespace Pratica05Pdo\Infrastructure\Persistence;

trait ConnectionCreator
{
    public static function CreateConnection() {
        $absoluteDatabasePath = __DIR__ . '../../../../database.sqlite';
        return new \PDO('sqlite:' . $absoluteDatabasePath);
    }
}
