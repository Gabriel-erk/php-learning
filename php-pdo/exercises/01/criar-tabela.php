<?php

$databaseAbsolutePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $databaseAbsolutePath);

$pdo->exec('CREATE TABLE students (name TEXT, birthDate TEXT)');

echo 'conectei';
