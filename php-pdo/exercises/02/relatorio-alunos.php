<?php

use Pratica02Pdo\Model\Student;

require_once 'src/Model/Student.php';

function exibirAluno(Student $student): void
{
    echo "Id: {$student->getId()}" . PHP_EOL;
    echo "Name: {$student->getName()}" . PHP_EOL;
    echo "Age: {$student->age()}" . PHP_EOL;
    echo "Birth Date: {$student->getBirthDate()->format('Y-m-d')}" . PHP_EOL;
}

$absoluteDatabasePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

$statement = $pdo->query('SELECT * from students');
$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);

$studentList = [];
foreach ($studentDataList as $studentData) {
    $studentList[] = new Student(
        $studentData['id'],
        $studentData['name'],
        new \DateTimeImmutable($studentData['birth_date'])
    );
}

echo '=== TODOS OS ALUNOS ===' . PHP_EOL;

foreach ($studentList as $student) {
    exibirAluno($student);
    echo '===================================' . PHP_EOL;
}

// exibindo as mesmas informações de acima, porém de um jeito mais 'cru'
var_dump($studentList);

// exibindo apenas um aluno
$statement = $pdo->query('SELECT * FROM students WHERE id = 2');
$studentData = $statement->fetch(PDO::FETCH_ASSOC);

$student = new Student(
    $studentData['id'],
    $studentData['name'],
    new \DateTimeImmutable($studentData['birth_date'])
);

echo '=== ALUNO ID 2 ===' . PHP_EOL;
exibirAluno($student);


// exibindo todos os alunos, porém, comendo menos memoria dessa vez, através do while
echo '=== EXIBIÇÃO DE ALUNOS CADASTRADOS COM MENOS CONSUMO DE MEMÓRIA ===' . PHP_EOL;
$statement = $pdo->query('SELECT * FROM students');

while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)) {
    $student = new Student(
        $studentData['id'],
        $studentData['name'],
        new \DateTimeImmutable($studentData['birth_date'])
    );
    $majority = $student->age() >= 18 ? 'true' : 'false';

    exibirAluno($student);
    echo "Majority: {$majority}" . PHP_EOL;
    echo '===================================' . PHP_EOL;
}
