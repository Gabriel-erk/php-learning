<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$pdo = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($pdo);
try {
    $studentList[] = $repository->allStudents();
    var_dump($studentList);
} catch (DateMalformedStringException $e) {
    echo $e->getMessage() . PHP_EOL;
}

