<?php 

namespace Pratica04Pdo\Src\Infrastructure\Persistence;

use PDO;

trait ConnectionCreator
{
    public static function CreateConnection(): PDO
    {
        return new PDO('sqlite:' . 'database.sqlite');
    }
}
