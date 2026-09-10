<?php

namespace Practice\Conta;

class ContaPoupanca extends Conta
{
    public const taxaRendimento = 0.1;
    public function __construct(int $numero, string $nome, float $saldo)
    {
        return parent::__construct($numero, $nome, $saldo);
    }

    public function sacar(float $valor): bool
    {
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
