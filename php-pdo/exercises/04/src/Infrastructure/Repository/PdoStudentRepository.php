<?php

namespace Pratica04Pdo\Src\Infrastructure\Repository;

require_once 'src/Infrastructure/Persistence/StudentCreator.php';

use Pratica04Pdo\Src\Domain\Model\Student;
use Pratica04Pdo\Src\Domain\Repository\StudentRepository;
use Pratica04Pdo\Src\Infrastructure\Persistence\StudentCreator;
use PDO;

class PdoStudentRepository implements StudentRepository
{
    private PDO $connection;
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    private function hydrateStudentList(\PDOStatement $stmt): array
    {
        $studentDataList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $studentList = [];

        foreach ($studentDataList as $studentData) {
            $studentList[] = StudentCreator::CreateStudent($studentData);
        }
        return $studentList;
    }

    public function allStudents(): array
    {
        $selectQuery = 'SELECT * FROM students';
        $stmt = $this->connection->query($selectQuery);

        return $this->hydrateStudentList($stmt);
    }

    public function studentsBirthAt(\DateTimeImmutable $birthDate): array
    {
        $query = 'SELECT * FROM students WHERE birth_date = ?';
        $stmt = $this->connection->prepare($query);
        $stmt->execute([
            $birthDate->format('Y-m-d')
        ]);
        return $this->hydrateStudentList($stmt);
    }

    public function save(Student $student): bool
    {
        if ($this->insert($student)) {
            if ($student->id() === null) {
                $student->defineId($this->connection->lastInsertId());
            }
            return true;
        }

        return $this->update($student);
    }

    private function insert(Student $student): bool
    {
        $insertQuery = 'INSERT INTO students (name, birth_date) VALUES (:name, :birth_date)';
        $stmt = $this->connection->prepare($insertQuery);
        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

        return $stmt->execute();
    }

    public function findById(int $id): Student|null
    {
        $selectQuery = 'SELECT * FROM students WHERE id = ?';
        $stmt = $this->connection->prepare($selectQuery);

        if ($stmt->execute([$id])) {
            $studentData = $stmt->fetch(PDO::FETCH_ASSOC);
            return StudentCreator::CreateStudent($studentData);
        }

        return null;
    }

    public function showStudent(Student $student): void
    {
        echo "Id: {$student->id()}" . PHP_EOL;
        echo "Name: {$student->name()}" . PHP_EOL;
        echo "Birth Date: {$student->birthDate()->format('Y-m-d')}" . PHP_EOL;
        echo "Age: {$student->age()}" . PHP_EOL;
        echo "Majority: " . ($student->age() >= 18 ? 'Of legal age' : 'Minor') . PHP_EOL;

        echo PHP_EOL;
    }

    public function studentList(array $students ): void
    {
        foreach ($students as $student) {
            $this->showStudent($student);
        }
    }

    private function update(Student $student): bool
    {
        $updateSql = 'UPDATE students SET name = :name, birth_date = :birth_date WHERE id = :id';
        $stmt = $this->connection->prepare($updateSql);
        return $stmt->execute([
            ':name' => $student->name(),
            ':birth_date' => $student->birthDate()->format('Y-m-d'),
            ':id' => $student->id()
        ]);
    }

    public function remove(Student $student): bool
    {
        $removeQuery = 'DELETE FROM students WHERE id = ?';
        $stmt = $this->connection->prepare($removeQuery);
        return $stmt->execute([$student->id()]);
    }
}
