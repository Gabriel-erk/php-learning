<?php
namespace MaisOrganizacao\Model;

use MaisOrganizacao\Model\Trait\ValidacaoFinanceiraTb;

class ContaPoupancaTb extends ContaBancariaTb
{
    public function __construct(ClienteTb $cliente, float $saldo)
    {
        parent::__construct($cliente, $saldo, TipoContaTb::Poupanca);
    }

    public function sacar(float $valor): bool
    {
        if ($this->validarContaAtiva($this->ativa) && $valor <= $this->saldo && $this->validarValorPositivo($valor)) {
            $this->saldo -= $valor;
            return true;
        } else {
            return false;
        }
    }
}
