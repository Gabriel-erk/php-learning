<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use Pratica06Pdo\Domain\Model\Student;

class StudentCreator
{
    public static function CreateStudent(array $studentData): Student {
        return new Student();
    }
}