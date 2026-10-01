<?php

use Pratica02Pdo\Model\Student;

require_once 'src/Model/Student.php';

// criando conexão com banco
$absoluteDatabasePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

$statement = $pdo->query('SELECT * from students');

echo '=== Alunos presentes no banco ===' . PHP_EOL;
while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)) {
    $student = new Student(
        $studentData['id'],
        $studentData['name'],
        new \DateTimeImmutable($studentData['birth_date'])
    );
    echo 'Id:' . $student->getId() . PHP_EOL;
    echo 'Name:' . $student->getName() . PHP_EOL;
    echo 'Birth Date:' . $student->getBirthDate()->format('Y-m-d') . PHP_EOL;

    echo '=================================' . PHP_EOL;
}
