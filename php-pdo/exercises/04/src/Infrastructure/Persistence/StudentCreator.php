<?php

namespace Pratica04Pdo\Src\Infrastructure\Persistence;

use Pratica04Pdo\Src\Domain\Model\Student;


trait StudentCreator
{
    public static function CreateStudent(array $studentData): Student
    {
        return new Student(
            $studentData['id'],
            $studentData['name'],
            new \DateTimeImmutable('2006-11-28')
        );
    }
}
