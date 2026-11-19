<?php

namespace Alura\Pdo\Domain\Model;

class Phone
{
    private ?int $id;
    private string $areaCode;
    private string $number;

    // quando observamos a criação da tabela, podemos ver que a tabela que está por trás deste modelo aqui, possui uma coluna chamada student_id que nós não estamos representando no construtor abaixo, pois, segundo o instrutor, é algo que faz sentido apenas no 'mundo do banco de dados, não no real', por isso a falta de implementação disso aqui
    public function __construct(?int $id, string $areaCode, string $number)
    {
        $this->id = $id;
        $this->areaCode = $areaCode;
        $this->number = $number;
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
    public function getAreaCode(): string
    {
        return $this->areaCode;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }
}