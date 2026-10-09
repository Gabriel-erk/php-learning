<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Repository\StudentRepository;
use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use PDO;

// isso é uma implementação de repositório (o repositório que estamos implementando é o StudentRepository, onde aqui, sim, iremos explicitar os detalhes mais necessários para quem está envolvido diretamente nas partes 'detalhadas' importantes para quem esta participando do desenvolvimento, por isso, também, viemos para esta pasta aqui dentro de infraestrutura, como também é um repositório, também foi criada a subpasta Repository aqui, detalharemos neste arquivo coisas como a conexão com o banco, que, não é necessária/importante estar presente em definicṍes de regras de negócio, lá é APENAS as regras de negócio, nada extraordinariamente implementado por lá)
class PdoStudentRepository implements StudentRepository
{
    // propriedade privada do tipo PDO chamada connection, ela será responsavel por nossa conexão com nosso banco de dados sqlite (é um objeto do tipo PDO)
    private PDO $connection;
    public function __construct()
    {
        // inicializando nossa propriedade com o modificador de acesso como private com o retorno do método estatico da classe ConnectionCreator == objeto do tipo PDO, que recebe como parâmetro, em sua instância, informações necessárias para se conectar com algum banco de dados(sendo o primeiro parâmetro, o driver e outras informações necessárias para acessar o SEU banco daquele driver, onde, no nosso caso, é apenas a localização daquele arquivo)
        $this->connection = ConnectionCreator::createConnection();
    }
    public function allStudents(): array
    {
        // $stmt == $preparedStatement
        // $stmt = $this->connection->prepare('SELECT * FROM students');
        // $stmt->execute();
        $sqlQuery = 'SELECT * FROM students';
        // não é necessesário fazer um preparedStatement/preparar a query aqui pois não temos nenhum parâmetro, logo, se não temos parâmetro, não tem como haver um SQL injection, pois o usuário não consegue inserir absolutamente nada via terminal, logo, não é possível que nenhum SQL malicioso seja inserido no nosso sistema (já que ele não permite ninguém inserir nada)
        $stmt = $this->connection->query($sqlQuery);

        return $this->hydrateStudentList($stmt);
    }

    public function studentsBirhAt(\DateTimeImmutable $birthDate): array
    {
        $sqlQuery = 'SELECT * FROM students WHERE birth_date = ?';
        $stmt = $this->connection->prepare($sqlQuery);
        $stmt->bindValue(1, $birthDate->format('Y-m-d'));
        $stmt->execute();

        return $this->hydrateStudentList($stmt);
    }

    // traduzindo nome do método: hidratar lista de estudantes, objetivo desta prática: trazer os dados de uma camada (no nosso exemplo, do banco de dados) para outra (também no nosso exemplo: para o mundo dos objetos ou melhor: POO, para nossas classes e etc) esse é o conceito de HIDRATAR, trazer dados de uma camada para a outra
    // no método abaixo estamos trazendo todas as informações obtidas na EXECUÇÃO da query SQL dentro do nosso objeto $stmt (do tipo PDOStatement) em forma de array associativo, percorrendo essa lista com um foreach, instanciando objetos do tipo student com as informações que tiramos do banco, passando isso para uma lista de estudantes e, por fim, devolvendo essa lista com objetos do tipo Student (onde cada um tem as informações de uma única linha do banco de dados da nossa tabela students)
    // parâmetro: objeto do tipo PDOStatement JÁ executado
    private function hydrateStudentList(\PDOStatement $stmt): array
    {
        // $stmt == objeto do tipo PDOStatement, podendo ele ser um preparedStatement, ou apenas um PDOStatement gerado a partir do método query de um objeto do tipo PDO e etc
        // observação: só podemos usar o método fetchAll/fetch de um preparedStatement se ele JÁ foi executado, caso contrário não funcionará, caso cheguemos a receber de parâmetro deste método um objeto PDOStatement/preparedStatement e ele NÃO foi executado, dará erro, PORÉM, caso não seja um preparedStatement, apenas o retorno de uma linha como: $stmt = $this->connection->query($sqlQuery), dará certo, pois o retorno do método query é um objeto do tipo PDOStatement JÁ executado
        $studentDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new \DateTimeImmutable($studentData['birth_date'])
            );
        }
        return $studentList;
    }

    public function save(Student $student): bool
    {
        // verifica se o aluno já 'existe' (nesse caso aqui, faldno do banco de dados, um aluno que esse sistema considera existente, é um aluno presente no banco de dados, pois não é possível, devido as nossas regras de neǵocio (onde definimos na criação da nossa tabela students, que o campo ID de cada aluno, é uma chave primária (ou seja, não pode ser nulla) e possui o atributo de auto incremento, então próximo registro que entrar na tabela, vai ter o campo ID, como um número inteiro maior que o registro que entrou antes dele) ter registro naquela tabela, com id vazio, logo, aqui verificamos se o ID do estudante passado como parâmetro para este método aqui (save) tem o id EXATAMENTE igual a null, pois se tiver, ele não estive na tabela students, logo, devemos inseri-lo (e, consequentemente, ele terá seu id definido dentreo deste método)
        if ($student->id() === null) {
            return $this->insert($student);
        }

        // caso o id do objeto do tipo student passado para este método aqui (save()) não for nullo, iremos disparar o método update e atualizar as informações do objeto do tipo student E no banco de dados (menos o ID, obviamente, que é o identificador daquela entidade)
        return $this->update($student);
    }

    private function insert(Student $student): bool
    {
        // mesma coisa de: $sqlInsert
        $insertQuery = "INSERT INTO students (name, birth_date) VALUES (:name,:birth_date)";
        // mesma coisa de: $preparedStatement
        $stmt = $this->connection->prepare($insertQuery);

        // ao invés de chamarmos o método bindValue() ou bindParam() como vinhamos fazendo antes, dentro do método execute abaixo, podemos passar de parâmetro para ele um array associativo, onde cada indice (como abaixo: ':name') representa o parâmetro NOMEADO da string/instrução SQL que nosso objeto do tipo PDOStatement tem preparada dentro de si, graças ao método prepare da linha acima e depois de => é o valor daquele parâmetro nomeado, talvez a regra mude CASO a forma de representar um parâmetro que usarmos na string SQL for ? ao invés de :nomeDoSeuParâmetroAqui, porém, usando parâmetros NOMEADOS, é dessa forma que expliquei
        $success = $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d')
        ]);

        // forma que seria feito, caso na instrução SQL não tivesse parâmetros nomeados (no caso, seria ? no lugar dos parâmetros nomeados da instrução SQL que temos agora como :name e :birth_date), passariamos apenas um array númerico normal (sem chaves nomeadas de array associativo como :name, :birth_date etc)
        // $success = $stmt->execute([
        //     $student->name(),
        //     $student->birthDate()->format('Y-m-d')
        // ]);

        if ($success) {
            // se o valor da váriavel $success for igual a true, entra neste método aqui e dispara o método defineId do objeto do tipo Student que este método possui acesso (pois recebeu como parâmetro na chamada do mesmo) e como valor, passamos o ID definido pelo banco sqlite quando fizemos o insert deste estudante nas linhas acima com o $stmt->execute()
            // como sabemos que o último estudante a ser inserido na tabela students foi oq nós ACABAMOS de inserir, chamamos o método da nossa propriedade $connection (do tipo PDO) que possui um método chamado lastInsertId() que nos retorna exatamente o ID do último estudante inserido no banco (o que acabamos de inserir, com as informações do estudante que este método que estamos agora, recebeu de parâmetro, e com a definição automática do banco, trazemos aquele valor para cá)
            $student->defineId($this->connection->lastInsertId());
        }

        return $success;
    }

    private function update(Student $student): bool
    {
        $updateQuery = 'UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id;';
        $stmt = $this->connection->prepare($updateQuery);
        $stmt->bindValue(':name', $student->name(), PDO::PARAM_STR);
        $stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->bindValue(':id', $student->id(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function remove(Student $student): bool
    {
        $sqlInsert = "DELETE FROM students WHERE id = ?";

        // como boas práticas, a váriavel abaixo pode ser chamada de "$stmt" == $statement ao invés de preparedStatement, como eu fiz
        $preparedStatement = $this->connection->prepare($sqlInsert);
        $preparedStatement->bindValue(1, $student->id(), PDO::PARAM_INT);
        return $preparedStatement->execute();
    }
}
