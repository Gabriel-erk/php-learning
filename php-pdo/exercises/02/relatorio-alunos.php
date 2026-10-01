<?php

use Pratica02Pdo\Model\Student;

require_once 'src/Model/Student.php';

$absoluteDatabasePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:', $absoluteDatabasePath);

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
