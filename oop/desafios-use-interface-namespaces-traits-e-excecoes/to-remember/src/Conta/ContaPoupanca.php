<?php 

namespace Practice\Conta;

class ContaPoupanca extends Conta 
{
    public function __construct(int $numero, string $nome, float $saldo)
    {
        return parent::__construct($numero, $nome, $saldo);
    }
}
