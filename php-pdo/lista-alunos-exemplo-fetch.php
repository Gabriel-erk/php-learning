<?php

use Alura\Pdo\Domain\Model\Student;

require_once 'vendor/autoload.php';

$absoluteDatabasePath = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $absoluteDatabasePath);

// retorno da nossa querie: $pdo->query('SELECT * FROM students') é um statement, por isso o nome da váriavel que recebe o retorno dessa operação/querie é statement
// executando uma instrução SQL e pegando o retorno, que está dentro do banco de dados, diferente do método exec() do PDO (ou nossa váriavel $pdo que é uma instância da interface PDO) que retorna apenas a quantidade de linhas afetadas, o método query nos permite ter acesso aos possíveis valores de retorno de uma query sql que realizarmos em nosso banco de dados, como no exemplo abaixo, nossa váriavel statement recebe o retorno da query('SELECT * FROM students'), ou seja, a váriavel statement terá como valor todos os alunos da nossa tabela students
// ao executarmos o método query da interface PDO, ele nos retorna um objeto do tipo PDOStatement, uma instância dessa classe PDOStatement (por isso o nome da váriavel), logo, nossa váriavel statement, é uma instância da classe PDOStatement, que possui acesso a um método que nos permitirá VER todos os registros que ela tem dentro de si == fetchAll()
$statement = $pdo->query('SELECT * FROM students');
// por padrão o fetchAll tras os dados da seguinte maneira quando você os vê no terminal: ['nomeDaColunaNoBanco'] => (tipo) valorDaColuna e logo abaixo mostra da seguinte maneira: [indice]=>(tipo) valorDaColuna
// logo, o que podemos entender é que ele permite que acessemos os valores de cada coluna através ou do índice, ou pelo nome da coluna (como conseguimos ver pelo var_dump), logo: $studentsList = $statement->fetchAll(); echo $studentsList[0][1] ou $studentsList[0]['id'] que ambos lhe trarão a mesma informação, ele apenas permite formas diferentes de acessar os valores nele presentes
// var_dump($statement->fetchAll());
// aqui estamos criando nossa lista de estudantes, diferente das explicações acima, este aqui possui um detalhe a mais, que é o PRIMEIRO parâmetro do método fetchAll, onde estamos passando uma constante da interface PDO chamada FETCH_ASSOC, que vai fazer com que, na hora de trazer os dados da operação '$statement->fetchAll(), trará os dados apenas em forma de array associativo, não com indíces também, apenas o nome da coluna => valor (precisamos espeficicar que queremos desse jeito pois, por padrão, ele nos trás ambas as formas de visualização: através do nome da coluna (id, name, birth_date...) e com indíces de array (0,1,2...))
// $studentList = $statement->fetchAll(PDO::FETCH_ASSOC);
$studentDataList = $statement->fetchAll(PDO::FETCH_ASSOC);
$studentList = [];

foreach ($studentDataList as $studentData) {
    $studentList[] = new Student(
        $studentData['id'],
        $studentData['name'],
        // instância da classe DateTeimeImmutable por conta do new, onde estou convertendo a data que passei por parâmetro ($studentData['birth_date']) para um objeto que implemente a interface: DateTimeInterface, para que seja possível realizar a instância de um Student corretamente
        new \DateTimeImmutable($studentData['birth_date'])
    );
}

echo ' === ALUNOS === ' . PHP_EOL;
// exibindo valores da lista com objetos do tipo Student com o var_dump
var_dump($studentList);

// exemplo trazendo apenas UM dado dessa vez, não todos os registros da tabela 'students' apenas as informações da linha que tiver o ID == 1
$statement = $pdo->query('SELECT * FROM students WHERE id = 1');

// tradução do código abaixo: enquanto a váriavel atual ($studentData) estiver recebendo ( = ) QUALQUER valor da operação após o operador de igual ( $statement->fetch(PDO::FETCH_ASSOC ), execute o que estiver no corpo do while (que é uma instância de um novo objeto do tipo Student(obviamente, a partir da classe Student))
// ao chegar em um ponto que a operação $statement->fetch(PDO::FETCH_ASSOC) não tenha nenhum valor, está mesma operação retornará false, logo, não entrará no while
// outra observação importante sobre este código é que, conseguimos acessar TODOS os valores do banco de dados (mesmo que tenha 1.000.00.000) sem estourar nossa memória, pois não estamos armazenando isto em nenhum lugar, toda vez que o while verifica que a condição é verdadeira, a váriavel student é instanciada NOVAMENTE com novos dados, ele basicamente instância um objeto e logo em seguida o apaga da memória
while ($studentData = $statement->fetch(PDO::FETCH_ASSOC)) {
    $student = new Student(
        $studentData['id'],
        $studentData['name'],
        new \DateTimeImmutable($studentData['birth_date'])
    );

    echo $student->age() . PHP_EOL;
}


$studentData = $statement->fetch(PDO::FETCH_ASSOC);

echo ' === ALUNO COM ID UM === ' . PHP_EOL;
// exibindo o valor de studentData == o estudante com id um 
var_dump($studentData);
