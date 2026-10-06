<?php
namespace Pratica03Pdo\Src\Domain\Trait;

use Pratica03Pdo\Src\Domain\Model\Student;

trait StudentInstance
{
    public static function instance(array $studentData): Student
    {
        return new Student(
            $studentData['id'],
            $studentData['name'],
            new \DateTimeImmutable($studentData['birth_date'])
        );
    }
}
