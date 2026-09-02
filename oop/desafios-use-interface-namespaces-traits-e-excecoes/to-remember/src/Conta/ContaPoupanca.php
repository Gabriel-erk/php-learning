<?php

namespace Practice\Conta;

use Practice\Exceptions\{SaldoInsuficienteException, ValorInvalidoException};

class ContaPoupanca extends Conta
{

    public const taxaRendimento = 0.1;
    public function __construct(int $numero, string $nome, float $saldo)
    {
        return parent::__construct($numero, $nome, $saldo);
    }

    public function sacar(float $valor): bool|ValorInvalidoException|SaldoInsuficienteException
    {
        if ($this->saldo < 0) {
            throw new ValorInvalidoException();
        }

        if ($valor > $this->saldo) {
            throw new SaldoInsuficienteException();
        }

        $this->saldo -= $valor;
        return true;
    }

    public function aplicarRendimento(): bool
    {
        if ($this->saldo > 0) {
            $this->saldo += $this->saldo * self::taxaRendimento;
            return true;
        }

        return false;
    }
}
