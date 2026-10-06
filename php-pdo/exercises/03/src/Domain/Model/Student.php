<?php

namespace Pratica03Pdo\Src\Domain\Model;

class Student
{
    public function __construct(private ?int $id, private string $name, private \DateTimeImmutable $birthDate) {}


    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function birthDate(): \DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }

    public function showStudent(bool $situation = false): void
    {
        echo "Id: {$this->name()}" . PHP_EOL;
        echo "Name: {$this->name()}" . PHP_EOL;
        echo "Birth Date: {$this->birthDate()->format('Y-m-d')}" . PHP_EOL;
        if ($situation) {
            $majority = $this->age() >= 18 ? "Maior de idade" : "Menor de idade";
            echo "Situation: {$this->age()} anos - $majority" . PHP_EOL;
        }
        echo "===================================" . PHP_EOL;
    }
}
