<?php 

require_once 'vendor/autoload.php';

$absoluteDatabasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

// retorno da nossa querie: $pdo->query('SELECT * FROM students') é um statement, por isso o nome da váriavel que recebe o retorno dessa operação/querie é statement
// executando uma instrução SQL e pegando o retorno, que está dentro do banco de dados, diferente do método exec() do PDO (ou nossa váriavel $pdo que é uma instância da interface PDO) que retorna apenas a quantidade de linhas afetadas, o método query nos permite ter acesso aos possíveis valores de retorno de uma query sql que realizarmos em nosso banco de dados, como no exemplo abaixo, nossa váriavel statement recebe o retorno da query('SELECT * FROM students'), ou seja, a váriavel statement terá como valor todos os alunos da nossa tabela students
// ao executarmos o método query da interface PDO, ele nos retorna um objeto do tipo PDOStatement, uma instância dessa classe PDOStatement (por isso o nome da váriavel), logo, nossa váriavel statement, é uma instância da classe PDOStatement, que possui acesso a um método que nos permitirá VER todos os registros que ela tem dentro de si == fetchAll()
$statement = $pdo->query('SELECT * FROM students');
// por padrão o fetchAll tras os dados da seguinte maneira quando você os vê no terminal: ['nomeDaColunaNoBanco'] => (tipo) valorDaColuna e logo abaixo mostra da seguinte maneira: [indice]=>(tipo) valorDaColuna
// logo, o que podemos entender é que ele permite que acessemos os valores de cada coluna através ou do índice, ou pelo nome da coluna (como conseguimos ver pelo var_dump), logo: $studentsList = $statement->fetchAll(); echo $studentsList[0][1] ou $studentsList[0]['id'] que ambos lhe trarão a mesma informação, ele apenas permite formas diferentes de acessar os valores nele presentes
var_dump($statement->fetchAll());