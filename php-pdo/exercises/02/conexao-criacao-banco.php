<?php 

$absoluteDatabasePath = __DIR__ . '/database.sqlite';

$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

$pdo->exec('CREATE TABLE IF NOT EXISTS students (id INTEGER PRIMARY KEY, name TEXT, birth_date TEXT)');

echo 'table students created' . PHP_EOL;