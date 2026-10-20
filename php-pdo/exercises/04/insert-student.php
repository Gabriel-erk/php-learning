<?php

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';

use Pratica04Pdo\Src\Infrastructure\Persistence\ConnectionCreator;

$pdoConnection = ConnectionCreator::CreateConnection();

$sqlInsert = 'INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)';
$stmt = $pdoConnection->prepare($sqlInsert);
$stmt->execute([
    ':name' => 'Gabriel Erick Vicente',
    ':birth_date' => '2010-10-10'
]);
