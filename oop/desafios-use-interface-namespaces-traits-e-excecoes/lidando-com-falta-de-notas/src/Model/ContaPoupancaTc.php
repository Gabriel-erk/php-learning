<?php

namespace FaltaNotas\Model;
// possuo um namespace chamado de "FaltaNotas\Model", o namespace onde estamos agora devido a esse namespace lógico padrão é "FaltaNotas\Model\ContaPoupancaTc", todo símbolo que eu solicitar dentro dessa classe, será procurado apenas dentro do namespace "FaltaNotas\Model" ou "FaltaNotas\Model\ContaPoupancaTc", devido a minha divisão de pastas e namespaces, minha interface (que é necessária nesta classe aqui), não se encontra em nenhum dos namespaces citados acima, fazendo com que o sistema não o encontre
// a não ser que façamos a solicitação direta dele, utilizando seu caminho (ou namespace próprio), fazendo com que seja finalmente encontrado e possamos prosseguir normalmente com a aplicação 
use FaltaNotas\Contracts\OperacaoBancariaTc;
use FaltaNotas\Enums\TipoContaTc;
use FaltaNotas\Exception\{
    ContaInativaExceptionTc,
    SaldoInsuficienteExceptionTc,
    ValorInvalidoExceptionTc
};

class ContaPoupancaTc extends ContaBancariaTc implements OperacaoBancariaTc
{
    public function __construct(ClienteTc $cliente, float $saldo)
    {
        parent::__construct($cliente, $saldo, TipoContaTc::POUPANCA);
    }



    // implementando método de interface
    public function sacar(float $valor): bool
    {

        $this->contaInativaException($this->ativa);
        $this->saldoInsuficienteException($valor, $this->saldo);
        // se aplicasse aqui a verificação de saldo positivo também me daria o mesmo erro de não conseguir registrar o log de tentativa fracassada
        /* 
        * sem taxa e limite extra
        * só pode sacar até o saldo
        */
        if (
            $valor > 0 
        ) {
            $this->saldo -= $valor;
            $this->log("Saque realizado.");
            return true;
        } else {
            $this->log("Tentativa de saque fracassada.");
            return false;
        }
    }
}
