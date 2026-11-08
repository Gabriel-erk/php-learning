<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
require_once '../Infrastructure/Persistence/ConnectionCreator.php';

$pdo = ConnectionCreator::CreateConnection();

$pdo->exec('CREATE TABLE IF NOT EXISTS students (id INT PRIMARY KEY, name TEXT, birth_date TEXT)');