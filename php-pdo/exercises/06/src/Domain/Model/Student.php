<?php

namespace Pratica06Pdo\Domain\Model;
use Exception;

class Student
{
    public function __construct(private ?int $id, private string $name, private \DateTimeImmutable $birthDate)
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): bool
    {
        if (is_null($this->getId())) {
            $this->id = $id;
            return true;
        }
        throw new Exception('Estudante já possui ID definido.');
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBirthDate(): \DateTimeImmutable
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTimeImmutable $birthDate
     */
    public function setBirthDate(\DateTimeImmutable $birthDate): void
    {
        $this->birthDate = $birthDate;
    }
}