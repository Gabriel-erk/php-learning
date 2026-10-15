<?php

require_once 'src\Domain\Model\Student.php';
require_once  'src\Domain\Repository\StudentRepository.php';
require_once 'src\Infrastructure\Repository\PdoStudentRepository.php';
require_once 'src\Infrastructure\Persistence\ConnectionCreator.php';

use Pratica04Pdo\Src\Domain\Model\Student;
use Pratica04Pdo\Src\Domain\Repository\StudentRepository;
use Pratica04Pdo\Src\Infrastructure\Persistence\ConnectionCreator;
use Pratica04Pdo\Src\Infrastructure\Repository\PdoStudentRepository;

$pdoConnection = ConnectionCreator::CreateConnection();
// instanciando um objeto da classe PdoStudentRepository
$pdoStudentRepository = new PdoStudentRepository($pdoConnection);

for ($i=0; $i < 10; $i++) { 
    $student = new Student(
        null,
        "Student $i",
        new \DateTimeImmutable('1999-10-15')
    );
    if ($pdoStudentRepository->save($student)) {
        echo "Cadastro bem sucedido do estudante com id: {}";
        // finalizar depois com método criado
        $student = 0;
    }
    
}
