<?php
// criando conexão com banco
$absoluteDatabasePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

// $pdo->exec("INSERT INTO students (name, birth_date) VALUES ('teste menor de idade', '2010-11-25')");
// exit();

for ($i = 0; $i < 10; $i++) {
    $pdo->exec("INSERT INTO students (name, birth_date) VALUES ('Estudante {$i}', '2006-11-28')");
}

echo "10 alunos inseridos com sucesso.";
