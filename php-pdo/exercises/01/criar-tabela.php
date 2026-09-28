<?php

$databaseAbsolutePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $databaseAbsolutePath);

$pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT)');

echo 'conectei' . PHP_EOL;
