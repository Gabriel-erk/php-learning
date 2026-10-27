<?php

namespace Pratica05Pdo\Domain\Model;
use DomainException;

class Student
{
    public function __construct(private ?int $id, private string $name, private \DateTimeImmutable $birthDate) {}

    public function defineId(int $id): bool|DomainException
    {
        if (is_null($this->id)) {
            $this->id = $id;
            return true;
        }
        throw new DomainException('Objeto já possui id definido.');
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function birthDate(): \DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function changeBirthDate(\DateTimeImmutable $birthDate): void
    {
        $this->birthDate = $birthDate;
    }

    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }
}
