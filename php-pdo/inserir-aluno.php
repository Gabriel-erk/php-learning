<?php 

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$absoluteDatabasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

$student = new Student(null, 'Vinicius Dias', new \DateTimeImmutable('2006-11-28'));

// váriavel $sqlInsert possui como valor, uma string, que nada mais é que um comando sql que passaremos para o nosso banco de dados executar e estar inserindo um estudante na tabela students do nosso db em sqlite com as informações presentes na string em cada campo do mesmo, para o campo birth_date, que estamos passando, ele está formatado em 'ano-mes-dia' através de um método que o tipo da nossa popriedade birth_date possue (que nada mais é que uma interface de datas)
$sqlInsert = "INSERT INTO students (name, birth_date) VALUES ('{$student->name()}', '{$student->birthDate()->format('Y-m-d')}')";

// ao utilizar o exec(comandoSqlAqui) nos é retornado a quantidade de linhas afetadas, que podemos utilizar ao nosso bel prazer, vamos fazer uso do var_dump para ter acesso a quantidade de linhas afetadas pela nossa operação abaixo (rodar um sqlInsert de um estudante na tabela estudantes, onde supostamente deve nos exibir o valor 1, já que está operação deve afetar apenas UMA linha no banco de dados)
var_dump($pdo->exec($sqlInsert));