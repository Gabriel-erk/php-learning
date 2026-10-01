<?php 

$absoluteDatabasePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

var_dump($pdo->exec('DROP TABLE IF EXISTS students'));

