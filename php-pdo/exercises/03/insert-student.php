<?php

use Pratica03Pdo\Src\Infrastructure\Persistence\ConnectionCreator;

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';

$pdo = ConnectionCreator::CreateConnection();

$sqlInsert = 'INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)';

// uma linha sql pode ser preparada apenas uma única vez e utilizada várias outras vezes, como estamos fazendo no for abaixo
$preparedStatement = $pdo->prepare($sqlInsert);

for ($i = 0; $i < 10; $i++) {
    $preparedStatement->bindValue(':name', "Student {$i}", PDO::PARAM_STR);
    $preparedStatement->bindValue(':birth_date', '2006-11-28', PDO::PARAM_STR);
    if ($preparedStatement->execute()) {
        echo "Student {$i} OK" . PHP_EOL;
    }
}
