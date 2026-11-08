<?php

use Pratica06Pdo\Infrastructure\Persistence\ConnectionCreator;
require_once '../Infrastructure/Persistence/ConnectionCreator.php';

$pdo = ConnectionCreator::CreateConnection();

$pdo->beginTransaction();
$stmt = $pdo->prepare('INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)');

for($i = 1; $i <= 10; $i++) {
    $stmt->bindValue(':name', "Student $i");
    $stmt->bindValue(':birth_date', new DateTimeImmutable("10-01-2001"));
    $stmt->execute();
}