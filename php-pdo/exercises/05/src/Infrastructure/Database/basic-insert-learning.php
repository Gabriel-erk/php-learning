<?php

use Pratica05Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once '../Persistence/ConnectionCreator.php';
require_once '../Repository/PdoStudentRepository.php';

$pdoConnection = ConnectionCreator::CreateConnection();

// inserindo primeiro aluno maior de idade
$sql =
    'INSERT INTO students (name, birth_date)
VALUES (:name, :birth_date)';
$stmt = $pdoConnection->prepare($sql);
$stmt->execute([
    ':name' => 'Pedro Nascimento',
    ':birth_date' => '2000-10-10'
]);

// inserindo segundo aluno maior de idade
// como já preparei uma vez na primeira inserção, eu não preciso preparar meu objeto (PDOStatement) novamente, apenas exeuctar passando os valores diferentes (já tenho um prepared statement, não preciso repetir o processo de preparar novamente, pois também estou usando a mesma string SQL)
$stmt->execute([
    ':name' => 'Ana Souza',
    ':birth_date' => '2005-09-09'
]);

// inserindo primeiro aluno menor de idade
$stmt->execute([
    ':name' => 'Júlia Costa',
    ':birth_date' => '2010-08-08'
]);

// inserindo segundo aluno menor de idade
$stmt->execute([
    ':name' => 'Lucas Alves',
    ':birth_date' => '2015-07-07'
]);

