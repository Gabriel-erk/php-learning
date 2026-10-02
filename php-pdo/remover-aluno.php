<?php

require_once 'vendor/autoload.php';

$absoluteDatabasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

$preparedStatement = $pdo->prepare('DELETE FROM students WHERE id = ?');
$preparedStatement->bindValue(1, 4, PDO::PARAM_INT);
var_dump($preparedStatement->execute());
