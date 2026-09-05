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
        $this->registrarOperacao("Saque de: $valor realizado com sucesso!");
        return true;
    }

    public function aplicarRendimento(): bool
    {
        if ($this->saldo > 0) {
            $rendimento = $this->saldo * self::taxaRendimento;

            $this->saldo += $rendimento;
            $this->registrarOperacao("Aplicação de rendimento de R\$ $rendimento");

            return true;
        }

        return false;
    }
}
