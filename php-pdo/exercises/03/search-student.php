<?php

use Pratica03Pdo\Src\Infrastructure\Persistence\ConnectionCreator;
use Pratica03Pdo\Src\Domain\Model\Student;

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'src/Domain/Model/Student.php';

$pdo = ConnectionCreator::CreateConnection();

$statement = $pdo->query('SELECT * FROM students WHERE id = 1');
$studentData = $statement->fetch(PDO::FETCH_ASSOC);

$student = new Student(
    $studentData['id'],
    $studentData['name'],
    new \DateTimeImmutable($studentData['birth_date'])
);

$student->showStudent();
