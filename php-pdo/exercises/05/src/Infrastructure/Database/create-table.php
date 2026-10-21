<?php 

use Pratica05Pdo\Infrastructure\Persistence\ConnectionCreator;
require_once '../Persistence/ConnectionCreator.php';

$pdoConnection = ConnectionCreator::CreateConnection();
$sql = 'CREATE TABLE IF NOT EXISTS students (id INTEGER PRIMARY KEY, name TEXT, birth_Date TEXT);';
$pdoConnection->exec($sql);