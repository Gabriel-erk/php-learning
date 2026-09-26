<?php


require_once 'src/Domain/Model/Student.php';
require_once 'vendor/autoload.php';
use Pratica01Pdo\Model\Student;

$databaseAbsolutePath = __DIR__ . '/database.sqlite';

$pdo = new PDO("sqlite:" . $databaseAbsolutePath);

$jeremy = new Student('Jeremy', new DateTimeImmutable('2006-11-28'));
$george = new Student('George', new DateTimeImmutable('2005-11-25'));

$pdo->exec("INSERT INTO students (name, birthDate) VALUES ({$jeremy->name()}, {$george->birthDate()->format('Y-m-d')}");
