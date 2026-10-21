<?php

namespace Pratica05Pdo\Domain\Repository;

use Pratica05Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents(): array;
    public function findById(): ?Student;
    public function studentsBirthAt(): array;
    public function save(Student $student): bool;
    public function delete(Student $student): bool;
}
