<?php

use Pratica01Pdo\Model\Student;

require_once 'src/Domain/Model/Student.php';
// conexão ao banco sqlite
$databaseAbsolutePath = __DIR__ . '/database.sqlite';
$pdo = new PDO('sqlite:' . $databaseAbsolutePath);

// toda vez que utilizamos o método query, nos é retornadao um objeto do tipo PDO statement, por isso o nome 'statement' a essa váriavel
$statement = $pdo->query('SELECT * FROM students');
// passandos os dados dos estudantes para um array
// para trazermos TODAS as informações do statement usamos o método fetchAll()
// para personalizarmos a busca para algo fora do seu padrão (trazer os dados em forma de array associativo E com indíces) usamos o parâmetro PDO::FETCH_ASSOC (constante da classe PDO que tras os dados APENAS em forma de array associativo, onde o nome da chave é o mesmo nome daquela coluna no banco de dados)
$studentsData = $statement->fetchAll(PDO::FETCH_ASSOC);

// listagem dos dados encontrados dentro do nosso array
echo '==== Listagem dados banco ====' . PHP_EOL;
foreach ($studentsData as $studentData) {
    echo "Name: {$studentData['name']}" . PHP_EOL;
    echo "Birth Date: {$studentData['birth_date']}" . PHP_EOL;
}

// conversão dos dados encontrados no banco para objetos do tipo student
echo '==== Listagem dos dados do banco convertidos para objetos ====' . PHP_EOL;
$studentsList = [];

foreach ($studentsData as $studentData) {
    $studentsList[] = new Student($studentData['name'], new \DateTimeImmutable($studentData['birth_date']));
}

var_dump($studentsList);
