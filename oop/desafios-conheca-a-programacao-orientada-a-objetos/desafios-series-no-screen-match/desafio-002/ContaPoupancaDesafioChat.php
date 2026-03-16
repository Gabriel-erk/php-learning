<?php

class ContaPoupancaDesafioChat extends ContaBancariaDesafioChat
{
    public function __construct(ClienteDesafioChat $cliente, float $saldo)
    {
        parent::__construct($cliente, $saldo);
    }
    
    // reescrevendo classe sacar apenas com a regra de que não é possível sacar valores negativos e zero e que aqui não aplicamos a taxa/limite de saque
    // chat corrigiu e falou que tava errado mesmo ele passando q era pra ter só essa regra no bagui
    public function sacar(float $valor): bool
    {
        if ($valor >= 0 && $valor <= self::LIMITE_SAQUE_PADRAO && $this->estaAtiva() && $valor <= $this->getSaldo()) {
            $this->saldo -= $valor;
            return true;
        } else {
            return false;
        }
    }

}
