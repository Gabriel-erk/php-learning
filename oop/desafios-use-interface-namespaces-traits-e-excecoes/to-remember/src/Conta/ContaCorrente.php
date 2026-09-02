<?php

namespace Practice\Conta;

use Practice\Exceptions\{SaldoInsuficienteException, ValorInvalidoException};

class ContaCorrente extends Conta
{
    private int $limiteChequeEspecial;
    public function __construct(int $numero, string $nome, float $saldo)
    {
        $limiteChequeEspecial = 500;
        return parent::__construct($numero, $nome, $saldo);
    }

    public function sacar(float $valor): bool|ValorInvalidoException|SaldoInsuficienteException
    {
        $valorDisponivelSaque = $this->saldo + $this->limiteChequeEspecial;

        if ($this->saldo < 0) {
            throw new ValorInvalidoException();
        }

        if ($valor > $valorDisponivelSaque) {
            throw new SaldoInsuficienteException();
        }

        if ($this->saldo >= $valor) {
            $this->saldo -= $valor;
        } elseif ($this->limiteChequeEspecial >= $valor) {
            $this->limiteChequeEspecial -= $valor;
        }

        return true;
    }
}
