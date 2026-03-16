<?php

/**
 * não possui taxa
 * não pode sacar mais que o saldo
 * não pode sacar valor menor ou igual a zero
 */
class ContaPoupancaTa extends ContaBancariaTa
{
    public function __construct(ClienteTa $cliente, float $saldo)
    {
        parent::__construct($cliente, $saldo, TipoContaTa::Poupanca);
    }

    public function sacar(float $valor): bool
    {
        if ($valor <= $this->saldo && $valor >= 0 && $this->estaAtiva()) {
            $this->saldo -= $valor;
            return true;
        } else {
            return false;
        }
    }
}
