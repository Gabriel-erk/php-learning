<?php
// criando conexão com banco
$absoluteDatabasePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

for ($i = 0; $i < 10; $i++) {
    $pdo->exec("INSERT INTO students (name, birth_date) VALUES ('Estudante {$i}', '2006-11-28')");
}

echo "10 alunos inseridos com sucesso.";
