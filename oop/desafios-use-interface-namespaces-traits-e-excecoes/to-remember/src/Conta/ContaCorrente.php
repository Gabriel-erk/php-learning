<?php

namespace Practice\Conta;

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

        $this->historico[] = $this->registrarOperacao("Saque de: ", $valorSaque);
        return true;
    }
}
