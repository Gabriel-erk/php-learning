<?php

namespace Practice\Conta;

use Override;
use Practice\Exceptions\{SaldoInsuficienteException, ValorInvalidoException};
use Practice\Contracts\Tributavel;

class ContaCorrente extends Conta implements Tributavel
{
    private int $limiteChequeEspecial;
    public function __construct(int $numero, string $nome, float $saldo)
    {
        $limiteChequeEspecial = 500;
        return parent::__construct($numero, $nome, $saldo);
    }

    
    public function calculcarTaxa(): float
    {
        return $this->saldo * 0.10;
    }

    public function sacar(float $valor): bool
    {
        $taxa = $this->calculcarTaxa();
        $valorSaque = $valor + $taxa;

        if ($this->saldo >= $valorSaque) {
            $this->saldo -= $valorSaque;
        } elseif ($this->limiteChequeEspecial >= $valorSaque) {
            $this->limiteChequeEspecial -= $valorSaque;
        }

        $this->registrarOperacao("Saque de: $valorSaque realizado com sucesso!");
        return true;
    }
}
