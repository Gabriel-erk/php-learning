<?php

$absoluteDatabasePath = __DIR__ . '/banco.sqlite';

$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

$pdo->exec(
    'DROP TABLE IF EXISTS students'
);