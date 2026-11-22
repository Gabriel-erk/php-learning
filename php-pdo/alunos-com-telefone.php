<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($connection);
try {
    // utilizando comentário abaixo para especificar a IDE que o array $studentsWithPhone é um array de objetos do tipo Student
    /** @var Student[] $studentsWithPhone */
    $studentsWithPhone = $repository->studentsWithPhone();
    echo $studentsWithPhone[1]->getPhones() [0]->formattedPhone();
    var_dump($studentsWithPhone);
} catch (DateMalformedStringException $e) {
    echo $e->getMessage();
}