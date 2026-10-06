<?php

use Pratica03Pdo\Src\Infrastructure\Persistence\ConnectionCreator;
use Pratica03Pdo\Src\Domain\Model\Student;
use Pratica03Pdo\Src\Domain\Trait\StudentInstance;

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'src/Domain/Model/Student.php';
require_once 'src/Domain/Trait/StudentInstance.php';

$pdo = ConnectionCreator::CreateConnection();

$statement = $pdo->query('SELECT * FROM students');
$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
$studentList = [];

foreach ($studentDataList as $studentData) {
    $studentList[] = StudentInstance::instance($studentData);
}

echo "=== TODOS OS ALUNOS ===" . PHP_EOL;
foreach ($studentList as $student) {
    $student->showStudent();
}

echo "=== ALUNO COM ID 5 ===" . PHP_EOL;

// preparando instrução SQL para evitar SQL injection, passando parâmetros e especificando seus tipos através do bindValue e por fim, executando esta linha sql para por fim, conseguir buscar as informações que restaram no meu objeto do tipo PDOStatement (preparedStatement)
$preparedStatement = $pdo->prepare('SELECT * FROM students WHERE id = ?');
$preparedStatement->bindValue(1, 5, PDO::PARAM_INT);
$preparedStatement->execute();

$studentData = $preparedStatement->fetch(PDO::FETCH_ASSOC);

$student = StudentInstance::instance($studentData);
$student->showStudent();

echo "=== LISTAGEM DE ALUNOS COM WHILE ===" . PHP_EOL;

$preparedStatement = $pdo->prepare('SELECT * FROM students');
$preparedStatement->execute();

while ($studentData = $preparedStatement->fetch(PDO::FETCH_ASSOC)) {
    $student = StudentInstance::instance($studentData);
    $student->showStudent();
}
