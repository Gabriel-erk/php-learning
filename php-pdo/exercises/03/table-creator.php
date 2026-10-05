<?php

use Pratica03Pdo\Src\Infrastructure\Persistence\ConnectionCreator;

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';

$pdo = ConnectionCreator::CreateConnection();

$pdo->exec('CREATE TABLE IF NOT EXISTS students (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT )');
