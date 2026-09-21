<?php

namespace Alura\Pdo\Domain\Model;

class Student
{
    private ?int $id; // para identificarmos o numero de registro do nosso estudante  - ? aqui significa que o valor do nosso id pode ser nullo, e int que pode ser inteiro, logo  ?int' quer dizer que o valor da propriedade $id pode ser nullo ou inteiro
    private string $name;
    // \ aqui significa que estou chamando a interface do namespace global do php e evita que eu tenha de importar a interface\classe no começo do programa (ex: use DateTimeInterface)
    // DateTimeInterface é uma interface do php que recebe objetos do tipo data\hora que suas classes implementam ela (DateTimeInterface)
    private \DateTimeInterface $birthDate;

    public function __construct(?int $id, string $name, \DateTimeInterface $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
    }

    // getter da propriedad ID
    public function id(): ?int
    {
        return $this->id;
    }

    // getter da propriedade name do nosso objeto instanciado a partir desta classe
    public function name(): string
    {
        return $this->name;
    }

    // getter da propriedade BirthDate
    // retorna algo que implemente a interface DateTimeInterface
    public function birthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    // regra de negócio para calcular idade com base na porpriedade birthDate usando método de manipulação de data
    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }
}
