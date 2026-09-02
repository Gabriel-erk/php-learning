<?php

namespace Practice\Conta;

class ContaPoupanca extends Conta
{

    public const taxaRendimento = 0.1;
    public function __construct(int $numero, string $nome, float $saldo)
    {
        return parent::__construct($numero, $nome, $saldo);
    }

    public function aplicarRendimento(): bool|float
    {
        if ($this->saldo > 0) {
            return $this->saldo += $this->saldo * self::taxaRendimento;
        }

        return false;
    }
}
