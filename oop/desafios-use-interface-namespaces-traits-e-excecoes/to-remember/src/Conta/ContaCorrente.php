<?php

namespace Practice\Conta;

use Practice\Contracts\Tributavel;

class ContaCorrente extends Conta implements Tributavel
{
    private int $limiteChequeEspecial;
    public function __construct(int $numero, string $nome, float $saldo)
    {
        $this->limiteChequeEspecial = 500;
        return parent::__construct($numero, $nome, $saldo);
    }


    public function calculcarTaxa(): float
    {
        $this->historico[] = $this->registrarOperacao('Cálculo de taxa de: ', $this->saldo * 0.10);
        return $this->saldo * 0.10;
    }

    public function sacar(float $valor): bool
    {
        $taxa = $this->calculcarTaxa();
        $valorSaque = $valor + $taxa;

        if ($this->saldo >= $valorSaque) {
            $this->historico[] = $this->registrarOperacao("Saque de: ", $valorSaque);
            
            $this->saldo -= $valorSaque;
            return true;
        } elseif ($this->limiteChequeEspecial >= $valorSaque) {
            $this->historico[] = $this->registrarOperacao("Saque de: ", $valorSaque);
            $this->limiteChequeEspecial -= $valorSaque;
            return true;
        }

        $this->historico[] = $this->registrarOperacao("Tentativa fracassada de saque de: ", $valorSaque);
        return false;
    }

    public function getLimiteChequeEspecial(): int
    {
        return $this->limiteChequeEspecial;
    }
}
