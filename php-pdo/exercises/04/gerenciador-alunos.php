<?php

require_once 'src\Domain\Model\Student.php';
require_once  'src\Domain\Repository\StudentRepository.php';
require_once 'src\Infrastructure\Repository\PdoStudentRepository.php';
require_once 'src\Infrastructure\Persistence\ConnectionCreator.php';

use Pratica04Pdo\Src\Domain\Model\Student;
use Pratica04Pdo\Src\Domain\Repository\StudentRepository;
use Pratica04Pdo\Src\Infrastructure\Repository\PdoStudentRepository;

$absoluteDatabasePath = __DIR__ . 'database.sqlite';
$pdoConnection = new PDO('sqlite:' . $absoluteDatabasePath);
// instanciando um objeto da classe PdoStudentRepository
$pdoStudentRepository = new PdoStudentRepository($pdoConnection);
