<?php
namespace MaisOrganizacao\Model;

use MaisOrganizacao\Model\Trait\ValidacaoFinanceiraTb;

// não é possível depositar nessa conta
class ContaSalarioTb extends ContaBancariaTb
{
    public function __construct(ClienteTb $cliente, float $saldo)
    {
        parent::__construct($cliente, $saldo, TipoContaTb::Salario);
    }

    // não possui taxa
    public function sacar(float $valor): bool
    {
        if ($this->ativa && $valor <= $this->saldo && $valor > 0) {
            $this->saldo -= $valor;
            return true;
        } else {
            return false;
        }
    }

    // depositos na conta salário podem ser feitos apenas pelo método depositarSalário, não o metodo "depositar" que herdamos da classe pai, então sobrescrevemos o método "depositar" da classe pai para se adaptar as regras de negócio dessa classe, fazendo com que o método "depositar" desta classe use o método "depositarSalario", onde as verificações e o depósito irão acontecer de fato, e não em "depositar"
    public function depositar(float $valor): bool
    {
        if ($this->depositarSalario($valor)) {
            return true;
        } else {
            return false;
        }
    }

    public function depositarSalario(float $valor): bool
    {
        if ($this->validarContaAtiva($this->ativa) && $this->validarValorPositivo($valor)) {
            $this->saldo += $valor;
            return true;
        } else {
            return false;
        }
    }
}
