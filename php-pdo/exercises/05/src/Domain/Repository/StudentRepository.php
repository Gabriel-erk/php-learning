<?php

namespace Pratica05Pdo\Domain\Repository;

use Pratica05Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents(): array;
    public function findById(int $id): ?Student;
    public function studentsBirthAt(\DateTimeImmutable $birthDate): array;
    public function save(Student $student): bool;
    public function delete(Student $student): bool;
}
