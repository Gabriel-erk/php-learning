<?php

class ContaCorrenteTa extends ContaBancariaTa
{
    public const TAXA_MANUTENCAO = 400;
    public function __construct(ClienteTa $cliente, float $saldo)
    {
        parent::__construct($cliente, $saldo, TipoContaTa::Corrente);
    }
    // implementando método sacar na classe filha de "ContaBancariaTa" onde o método sacar foi definido como abstrato (ou seja, defindo para ter sua implementação/definição do seu comportamento/body de método nas classes filhas obrigatoriamente contando que elas não sejam abstratas também)
    // conceito também de polimorfismo onde o mesmo método pode assumir diferentes formas
    public function sacar(float $valor): bool
    {
        if ($valor > 0 && $valor + self::TAXA_MANUTENCAO <= $this->saldo && $valor <= self::LIMITE_SAQUE_PADRAO_TA && $this->estaAtiva()) {
            $this->saldo -= $valor + self::TAXA_MANUTENCAO;
            return true;
        } else {
            return false;
        }
    }
}
