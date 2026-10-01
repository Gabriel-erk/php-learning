<?php

namespace Pratica02Pdo\Model;

class Student
{
    public function __construct(private ?int $id, private string $name, private \DateTimeImmutable $birthDate) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBirthDate(): \DateTimeImmutable
    {
        return $this->birthDate;
    }
}
