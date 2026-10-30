<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$pdoStudentRepository = new PdoStudentRepository($connection);
// objetivo de algumas linhas abaixo: inserir 10 alunos em uma turma sob a condição de que, caso um não seja inserido, nenhum outro vai (um contexto plausível para isso é que, caso uma turma tenha requisitos obrigatórios para sua criação algo como: para CRIAR a turma, é necessário 10 alunos, isso que iremos fazer EVITA criar a turma de forma desnecessária e depois apagá-la, em caso de algum erro)
// transações de forma bem porca só para passar por essa aula: ou todas suas instruções (da transação) funcionam, ou nenhuma funciona, ou tudo da certo ou NADA dá certo (por exemplo, ou inserir 10 alunos da certo, ou nenhum, de forma melhor, se QUALQUER aluno der erro, eu não insiro nenhum dos 10 no banco de dados)

// como meu objeto do tipo PDO chamado connection está FORA da instância do meu repositório (o que é um bom ponto, segundo o instrutor), posso simplesmente iniciar uma transação assim
// ao fazer isso (disparar o método para começar uma transação: beginTransaction() através de um objeto do tipo PDO) o PDO vai no banco de dados e desativa a execução de CADA UMA das queries todas as vezes que elas forem executadas, ou seja: quando eu mandar uma query para o banco de dados (uma das instruções que minha transação possui), ele não vai EXECUTAR aquilo de fato no banco de dados (que é o nosso objetivo, só queremos EXECUTAR, fazer com que nossa instrução seja aderida de fato no banco apenas se TODAS as instruções da nossa transação forem bem sucedidas), ele vai deixar a nossa query 'guardada' para ser executada no final da nossa transação, ou seja, caso todas suas instruções sejam devidamente atendidas
$connection->beginTransaction();

$aStudent = new Student(
    null,
    'Nico Steppat',
    new DateTimeImmutable('1985-05-01')
);
// como eu iniciei uma transação na linha acima com a MESMA conexão que este meu objeto abaixo ($pdoStudentRepository) tem acesso, o programa vai fluir como eu desejo, porém, se no meu repositório fosse uma conexão DIFERENTE da qual eu estou iniciando minha transação, não daria certo e o programa não iria fluir da forma que eu quero (erro semântico)
$pdoStudentRepository->save($aStudent);

$anotherStudent = new Student(
    null,
    'Sérgio Lopes',
    new DateTimeImmutable('1986-06-02')
);
$pdoStudentRepository->save($anotherStudent);

$connection->commit();