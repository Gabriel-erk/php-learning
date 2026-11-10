<?php

namespace Pratica06Pdo\Domain\Model;

use Exception;

class Customer
{
    public function __construct(private ?int $id, private string $name, private string $email)
    {

    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param int|null $id
     * @throws Exception
     */
    public function setId(?int $id): void
    {
        if ($this->getId() == null) {
            $this->id = $id;
        } else {
            throw new Exception('ID do cliente já foi definido.');
        }
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function show(): void
    {
        echo "Name: {$this->getName()} - Email: {$this->getEmail()}" . PHP_EOL;
    }
}