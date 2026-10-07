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
        return [];
    }

    public function save(Student $student): bool
    {
        $sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name,:birth_date)";

        $preparedStatement = $this->connection->prepare($sqlInsert);
        $preparedStatement->bindValue(':name', $student->name());
        $preparedStatement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

        return $preparedStatement->execute();
    }

    public function remove(Student $student): bool
    {
        $sqlInsert = "DELETE FROM students WHERE id = ?";

        $preparedStatement = $this->connection->prepare($sqlInsert);
        $preparedStatement->bindValue(1, $student->id());
        return $preparedStatement->execute();
    }
}
