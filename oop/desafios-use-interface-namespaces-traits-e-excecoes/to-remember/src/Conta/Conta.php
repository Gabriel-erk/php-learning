<?php

namespace Practice\Conta;

use Practice\Exceptions\{SaldoInsuficienteException, ValorInvalidoException};

// é uma classe abstrata pois o saque de uma conta corrente e conta poupança são diferentes e eu quero que esta classe "conta" seja apenas um molde para que minhas classes "ContaCorrente" e "ContaPoupanca" possam usar e depois aplicar suas próprias diferenças (nisso já faremos uso de polimorfismo e e herança)
abstract class Conta
{
    public function __construct(public readonly int $numero, public readonly string $nome, protected float $saldo) {}

    public function depositar(float $valor): bool|ValorInvalidoException
    {
        if ($valor > 0) {
            $this->saldo += $valor;
            return true;
        } else {
            throw new ValorInvalidoException();
        }
    }

    public abstract function sacar(float $valor): bool|ValorInvalidoException|SaldoInsuficienteException;

    public function consultarSaldo()
    {
        return $this->saldo;
    }
}
