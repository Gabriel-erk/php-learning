<?php

namespace Practice\Conta;

use FaltaNotas\Exception\SaldoInsuficienteExceptionTc;
use Practic\Exceptions\ValorInvalidoExcepiton;
use Practice\Exceptions;
use Practice\Exceptions\SaldoInsuficienteException;

// é uma classe abstrata pois o saque de uma conta corrente e conta poupança são diferentes e eu quero que esta classe "conta" seja apenas um molde para que minhas classes "ContaCorrente" e "ContaPoupanca" possam usar e depois aplicar suas próprias diferenças (nisso já faremos uso de polimorfismo e e herança)
abstract class Conta
{
    public function __construct(public readonly int $numero, public readonly string $nome, private float $saldo) {}

    public function depositar(float $valor): bool|ValorInvalidoExcepiton
    {
        if ($valor > 0) {
            $this->saldo += $valor;
            return true;
        } else {
            throw new ValorInvalidoExcepiton();
        }
    }

    public function sacar(float $valor): bool|ValorInvalidoExcepiton|SaldoInsuficienteException
    {
        if ($valor < 0) {
            throw new ValorInvalidoExcepiton();
        }

        if ($valor > $this->saldo) {
            throw new SaldoInsuficienteException();
        }

        $this->saldo -= $valor;
        return true;
    }

    public function consultarSaldo() {
        return $this->saldo;
    }
}
