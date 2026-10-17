<?php 

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';

use Pratica04Pdo\Src\Infrastructure\Persistence\ConnectionCreator;

$pdo = ConnectionCreator::CreateConnection();

$pdo->exec('DROP TABLE IF EXISTS students');