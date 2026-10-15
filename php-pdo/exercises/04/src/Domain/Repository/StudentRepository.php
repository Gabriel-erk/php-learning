<?php 

namespace Pratica04Pdo\Src\Domain\Repository;
use Pratica04Pdo\Src\Domain\Model\Student;

interface StudentRepository {
    public function allStudents(): array;
    public function studentsBirthAt(\DateTimeImmutable $birthDate): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;
}
