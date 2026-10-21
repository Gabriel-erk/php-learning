<?php

namespace Pratica05Pdo\Infrastructure\Persistence;

use Pratica05Pdo\Domain\Model\Student;

trait StudentCreator
{
    public static function CreateStudent(array $studentData): Student
    {
        return new Student(
            $studentData['id'],
            $studentData['name'],
            $studentData['birth_date']
        );
    }
}
