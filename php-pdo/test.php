<?php 

$databaseAbsolutePath = __DIR__ . '/banco.sqlite';

$pdo = new PDO('sqlite:' . $databaseAbsolutePath);

// $pdo->exec('DROP TABLE students');

