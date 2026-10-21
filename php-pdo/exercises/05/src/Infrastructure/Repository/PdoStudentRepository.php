<?php

namespace Pratica05Pdo\Infrastructure\Repository;

use Pratica05Pdo\Domain\Model\Student;
use Pratica05Pdo\Domain\Repository\StudentRepository;
use Pratica05Pdo\Infrastructure\Persistence\StudentCreator;
use PDO;

class PdoStudentRepository implements StudentRepository
{
    private PDO $pdoConnection;

    public function __construct(PDO $pdoConnection)
    {
        $this->pdoConnection = $pdoConnection;
    }

    private function hydrateStudents(): array
    {
        return [];
    }

    public function allStudents(): array
    {
        return [];
    }

    public function findById(): ?Student
    {
        throw new \Exception('Not implemented');
    }

    public function studentsBirthAt(): array
    {
        return [];
    }

    public function save(Student $student): bool
    {
        return true;
    }

    private function insert(Student $student): bool
    {
        return false;
    }

    private function update(Student $student): bool
    {
        return true;
    }

    public function showStudent(): void {}

    public function studentList(): void {}

    public function delete(Student $student): bool
    {
        return true;
    }
}
