<?php

namespace Pratica06Pdo\Domain\Repository;

use Pratica06Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents();

    public function findById(int $id): ?Student;

    public function studentsBirthAt(\DateTimeImmutable $birthDate): ?array;

    public function save(Student $student): bool;

    public function delete(Student $student): bool;
}