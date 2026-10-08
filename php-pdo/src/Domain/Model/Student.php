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

    // como a propriedade ID pode ser null (se observamos sua definição em nosso construtor), foi adicionado este método que nos permite definir um ID para o nosso objeto do tipo aluno (apenas uma vez)
    // onde, como regra de negócio do método, quando chamado, verifica se o valor do campo ID do objeto student que chamou este método retornará false, se retornar false para o método !is_null, entrará no if (por causa do !) e jogará uma exeção dizendo que aquele objeto do tipo student já possui um ID definido, caso contrário, passará o valor recebido como parâmetro na assinatura do método abaixo para a propriedade Id do objeto do tipo Student que chamou o método defineID
    public function defineId(int $id): void
    {
        if (!is_null($this->id)) {
            throw new \DomainException('Você só pode definir o ID uma vez');
        }

        $this->id = $id;
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

    public function changeName(string $newName): void
    {
        $this->name = $newName;
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
