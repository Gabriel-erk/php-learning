<?php

use Pratica03Pdo\Src\Infrastructure\Persistence\ConnectionCreator;
use Pratica03Pdo\Src\Domain\Model\Student;

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'src/Domain/Model/Student.php';

$pdo = ConnectionCreator::CreateConnection();

