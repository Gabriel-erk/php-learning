<?php
namespace MaisOrganizacao\Model;

use MaisOrganizacao\Model\Trait\ValidacaoFinanceiraTb;

class ContaCorrenteTb extends ContaBancariaTb
{
    // definindo que o valor da nossa taxa saque é de 5% (porém em valores decimais, pois para sabermos por exemplo, 5% do saque atual é só multiplicar o valor de saque por essa constante)
    public const TAXA_SAQUE_TB = 0.05;
    private float $limiteDisponivel;

    public function __construct(ClienteTb $cliente, float $saldo)
    {
        parent::__construct($cliente, $saldo, TipoContaTb::Corrente);
        $this->limiteDisponivel = 300;
    }

    public function sacar(float $valor): bool
    {
        $taxaTotal = $valor * self::TAXA_SAQUE_TB;
        // problema deve estar aqui: $valor <= $valor + $taxaTotal
        // $this->saldo <= $valor + $taxaTotal, caso valor + taxaTotal forem maiores que o saldo, eu não posso sacar, pois será um valor maior que o que eu tenho disponível, logo, o que eu devo fazer é que o saque só seja possível SE o saldo disponivel for menor ou igual ao $valor (a ser sacado) + taxa de 5%
        if (
            $this->validarContaAtiva($this->ativa) &&
            $this->validarValorPositivo($valor) &&
            // condição anterior aqui estava o saldo ser menor ou igual o valor a se retirar + a taxa, porém veja comigo, se tenho um saldo de 30000 e quero tirar 10500, 30000 (saldo) é menor ou igual a 10500? (obviamente não, retorna false, o que faz com que ele não retorne exatamente o que eu quero, pois se 30000 é maior ou igual ao valor a se retirar (valor + taxa) eu POSSO retira-lo normalmente - erro de lógica aqui)
            $this->saldo >= $valor + $taxaTotal &&
            $valor <= self::LIMITE_SAQUE_PADRAO_TB
        ) {
            if (
                $this->saldo <= 0 &&
                $this->limiteDisponivel >= $valor + $taxaTotal
            ) {
                $this->limiteDisponivel -= $valor + $taxaTotal;
                return true;
            } else {
                $this->saldo -= $valor + $taxaTotal;
                return true;
            }
        } else {
            return false;
        }
    }
}
