<?php

namespace Practice\Conta;

use Practice\Exceptions\SaldoInsuficienteException;
use Practice\Exceptions\ValorInvalidoException;

class ContaPoupanca extends Conta
{
    public const taxaRendimento = 0.1;
    public function __construct(int $numero, string $nome, float $saldo)
    {
        return parent::__construct($numero, $nome, $saldo);
    }

    public function sacar(float $valor): bool|SaldoInsuficienteException|ValorInvalidoException
    {
        if ($valor < 0) {
            $this->historico[] = $this->registrarOperacao("Tentativa fracassada de saque de: ", $valor);

            throw new ValorInvalidoException();
        }

        if ($valor > $this->saldo) {
            $this->historico[] = $this->registrarOperacao("Tentativa fracassada de saque de: ", $valor);

            throw new SaldoInsuficienteException();
        }

        $this->saldo -= $valor;
        $this->historico[] = $this->registrarOperacao("Saque de: ", $valor);
        return true;
    }

    public function aplicarRendimento()
    {
        $rendimento = $this->saldo * self::taxaRendimento;

        $this->saldo += $rendimento;
        $this->historico[] = $this->registrarOperacao("Aplicação de rendimento de R\$: ", $rendimento);
    }
}
