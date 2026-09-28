<?php

require_once 'src/Domain/Model/Student.php';
require_once 'vendor/autoload.php';

use Pratica01Pdo\Model\Student;

$databaseAbsolutePath = __DIR__ . '/database.sqlite';

$pdo = new PDO("sqlite:" . $databaseAbsolutePath);

$jeremy = new Student('Jeremy', new DateTimeImmutable('2006-11-28'));
$george = new Student('George', new DateTimeImmutable('2005-11-25'));

echo $jeremy->birthDate()->format('Y-m-d') . PHP_EOL;

$sqlInsertAlunoUm = "INSERT INTO students (name, birth_date) VALUES ('{$jeremy->name()}', '{$jeremy->birthDate()->format('Y-m-d')}')";

if (
    $pdo->exec($sqlInsertAlunoUm) > 0
) {
    echo 'Jeremy cadastrado' . PHP_EOL ;
}

$sqlInsertAlunoDois = "INSERT INTO students (name, birth_date) VALUES ('{$george->name()}', '{$george->birthDate()->format('Y-m-d')}')";

if ($pdo->exec($sqlInsertAlunoDois)) {
    echo 'George cadastrado' . PHP_EOL;
}
