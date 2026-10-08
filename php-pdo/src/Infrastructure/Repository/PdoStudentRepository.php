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
        $preparedStatement = $this->connection->prepare('SELECT * FROM students');
        $preparedStatement->execute();

        $studentDataList = $preparedStatement->fetchAll(PDO::FETCH_ASSOC);
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

    public function studentsBirhAt(\DateTimeImmutable $birthDate): array
    {
        // PRIMEIRO JEITO DE FAZER ISSO
        // $preparedStatement = $this->connection->prepare('SELECT * FROM students WHERE birth_date = ?'); 
        // $preparedStatement->bindValue(1, $birthDate->format('Y-m-d'));
        // $preparedStatement->execute();
        // após os passos acima, recuperar os dados do banco com fetchAll ou fetch + while e converte-los para objetos do tipo Student para ai sim retornar o array completo

        // SEGUNDO JEITO DE FAZER ISSO
        $studentsList = $this->allStudents();
        $studentsBirthAt = [];
        foreach ($studentsList as $student) {
            if ($student->birthDate = $birthDate) {
                $studentsBirthAt[] = $student;
            }
        }

        return $studentsBirthAt;
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

        $student->defineId($this->connection->lastInsertId());

        return $success;
    }

    private function update(Student $student): bool
    {
        return true;
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
