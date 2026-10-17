<?php

namespace Pratica04Pdo\Src\Domain\Model;

class Student
{
    public function __construct(private ?int $id, private string $name, private \DateTimeImmutable $birthDate) {}

    public function id(): ?int
    {
        return $this->id;
    }

    public function defineId(int $id): bool
    {
        if ($this->id == null) {
            $this->id = $id;
            return true;
        }
        return false;
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
}
