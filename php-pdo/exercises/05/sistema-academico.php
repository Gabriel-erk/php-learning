<?php 

use Pratica05Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica05Pdo\Domain\Model\Student;
use Pratica05Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'Domain/Model/Student.php';
require_once 'Infrastructure/Repository/PdoStudentRepository.php';

$pdoConnection = ConnectionCreator::CreateConnection();
$pdoStudentRepository = new PdoStudentRepository($pdoConnection);
$students = $pdoStudentRepository->allStudents();

echo PHP_EOL . '=== CADASTRO REALIZADO ===' . PHP_EOL; 
foreach ($students as $student) {
    echo "ID: {$student->id()} | Name: {$student->name()}" . PHP_EOL;    
}