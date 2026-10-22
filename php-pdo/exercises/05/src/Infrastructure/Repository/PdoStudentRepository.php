<?php

namespace Pratica05Pdo\Infrastructure\Repository;

use Pratica05Pdo\Domain\Model\Student;
use Pratica05Pdo\Domain\Repository\StudentRepository;
use Pratica05Pdo\Infrastructure\Persistence\StudentCreator;
use PDO;
use PDOStatement;

class PdoStudentRepository implements StudentRepository
{
    private PDO $pdoConnection;

    public function __construct(PDO $pdoConnection)
    {
        $this->pdoConnection = $pdoConnection;
    }

    private function hydrateStudents(PDOStatement $stmt): array
    {
        $studentsData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $students = [];
        foreach ($studentsData as $studentData) {
            $students[] = StudentCreator::CreateStudent($studentData);
        }
        return $students;
    }

    public function allStudents(): array
    {
        $sql = 'SELECT * FROM students';
        $stmt = $this->pdoConnection->query($sql);
        $stmt->execute();
        return $this->hydrateStudents($stmt);
    }

    public function findById(int $id): ?Student
    {
        $sql =
            'SELECT * FROM students
        WHERE id = ?';

        $stmt = $this->pdoConnection->prepare($sql);
        $stmt->execute([$id]);
        
        $studentData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($studentData != null) {
            return StudentCreator::CreateStudent($studentData);
        }
        return null;
    }

    public function studentsBirthAt(\DateTimeImmutable $birthDate): array
    {
        $sql = 'SELECT * FROM students WHERE birth_date = ?';
        $stmt = $this->pdoConnection->prepare($sql);
        $stmt->bindValue(1, $birthDate->format('Y-m-d'));
        $stmt->execute();
        return $this->hydrateStudents($stmt);
    }

    public function save(Student $student): bool
    {
        // se o id do meu objeto do tipo anulo for EXATAMENTE IGUAL (igual em valor e tipo) ao valor null, significa que tenho que inseri-lo no banco de dados
        if ($student->id() === null) {
            return $this->insert($student);
        }
        // se o id do estudante não for EXATAMENTE IGUAL ao valor null, significa que ele já está no banco de dados e irei apenas atualiza-lo
        return $this->update($student);
    }

    private function insert(Student $student): bool
    {
        $sql =
            'INSERT INTO students (name, birth_date)
          VALUES (:name, :birth_date);';
        $stmt = $this->pdoConnection->prepare($sql);
        if (
            $stmt->execute([
                ':name' => $student->name(),
                ':birth_date' => $student->birthDate()->format('Y-m-d')
            ])
        ) {
            $student->defineId($this->pdoConnection->lastInsertId());
            return true;
        } else {
            return false;
        }
    }

    private function update(Student $student): bool
    {
        $sql =
            'UPDATE students
        SET name = :name, birth_date = :birth_date
        WHERE id = :id';
        $stmt = $this->pdoConnection->prepare($sql);
        return $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d'),
            ':id' => $student->id()
        ]);
    }

    public function showStudent(Student $student): void {}

    public function studentList(array $students): void
    {
        foreach ($students as $student) {
            echo PHP_EOL . PHP_EOL;
            $this->showStudent($student);
        }
    }

    public function delete(Student $student): bool
    {
        $sql = 'DELETE FROM students WHERE id = ?';
        $stmt = $this->pdoConnection->prepare($sql);
        return $stmt->execute([$student->id()]);
    }
}
