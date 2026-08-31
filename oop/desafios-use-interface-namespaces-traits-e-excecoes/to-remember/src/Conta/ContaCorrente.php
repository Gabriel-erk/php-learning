<?php

namespace Practice\Conta;

class ContaCorrente extends Conta
{
    public function __construct(int $numero, string $nome, float $saldo) {
        return parent::__construct($numero, $nome, $saldo);
    }
}
