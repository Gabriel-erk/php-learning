<?php

use Pratica05Pdo\Domain\Model\Student;
use Pratica05Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica05Pdo\Domain\Repository\StudentRepository;
use Pratica05Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once '../../Domain/Model/Student.php';
require_once '../../Domain/Repository/StudentRepository.php';
require_once '../Persistence/ConnectionCreator.php';
require_once '../Persistence/StudentCreator.php';
require_once '../Repository/PdoStudentRepository.php';

$pdoConnection = ConnectionCreator::CreateConnection();
$pdoStudentRepository = new PdoStudentRepository($pdoConnection);
$students = [];

// inserindo primeiro aluno MAIOR de idade
$students[] = new Student(
    null,
    'Pedro Nascimento',
    new DateTimeImmutable('2000-10-10')
);

// inserindo segundo aluno MAIOR de idade
$students[] = new Student(
    null,
    'Ana Souza',
    new DateTimeImmutable('2005-09-09')
);

// inserindo primeiro aluno MENOR de idade
$students[] = new Student(
    null,
    'Júlia Costa',
    new DateTimeImmutable('2010-08-08')
);

// inserindo segundo aluno MENOR de idade
$students[] = new Student(
    null,
    'Lucas Alves',
    new DateTimeImmutable('2015-07-07')
);

foreach ($students as $student) {
    $pdoStudentRepository->save($student);
}