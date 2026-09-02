<?php

namespace Practice\Conta;
use Practice\Exceptions;

class ContaCorrente extends Conta
{
    public const limiteChequeEspecial = 500;
    public function __construct(int $numero, string $nome, float $saldo) {
        return parent::__construct($numero, $nome, $saldo);
    }

   public function sacar(float $sacar): bool|ValorInvalidoExcepiton|SaldoInsuficienteException
   {
    # code...
   }
}
