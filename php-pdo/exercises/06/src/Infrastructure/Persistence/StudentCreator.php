<?php

namespace Pratica06Pdo\Infrastructure\Persistence;

use Pratica06Pdo\Domain\Model\Student;
use DateTimeImmutable;

class StudentCreator
{

    public static function CreateStudents(array $studentsData): array
    {
        $students = [];
        foreach ($studentsData as $studentData) {
            $students[] = StudentCreator::CreateStudent($studentData);
        }
        return $students;
    }

    public static function CreateStudent(array $studentData): Student
    {
        return new Student(
            $studentData['id'],
            $studentData['name'],
            new DateTimeImmutable($studentData['birth_date'])
        );
    }
}