<?php 

use Pratica05Pdo\Infrastructure\Persistence\ConnectionCreator;
require_once '../Persistence/ConnectionCreator.php';

$pdoConnection = ConnectionCreator::CreateConnection();
$sql = 'DROP TABLE students';
$pdoConnection->exec($sql);