<?php

namespace Pratica01Pdo\Model;

class Student
{
    public function __construct(private string $name, private \DateTimeImmutable $birthDate) {}

    public function name(): string
    {
        return $this->name;
    }

    public function birthDate(): \DateTimeImmutable
    {
        return $this->birthDate;
    }
}
