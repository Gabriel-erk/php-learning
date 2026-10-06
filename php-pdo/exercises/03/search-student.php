<?php

use Pratica03Pdo\Src\Infrastructure\Persistence\ConnectionCreator;
use Pratica03Pdo\Src\Domain\Trait\StudentInstance;

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'src/Domain/Model/Student.php';
require_once 'src/Domain/Trait/StudentInstance.php';

$pdo = ConnectionCreator::CreateConnection();

$preparedStatement = $pdo->prepare('SELECT * FROM students WHERE id = ?');
$preparedStatement->bindValue(1, 1, PDO::PARAM_INT);
$preparedStatement->execute();

$studentData = $preparedStatement->fetch(PDO::FETCH_ASSOC);

$student = StudentInstance::instance($studentData);

echo "=== ALUNO COM ID 1 ===" . PHP_EOL;
$student->showStudent();
