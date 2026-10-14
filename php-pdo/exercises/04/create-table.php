<?php 

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';

use Pratica04Pdo\Src\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::CreateConnection();

$pdo->exec('CREATE TABLE IF NOT EXISTS students (id PRIMARY KEY, name TEXT, birth_date TEXT)');