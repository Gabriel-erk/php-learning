<?php

namespace FaltaNotas\Model;

use FaltaNotas\Contracts\{
    OperacaoBancariaTc,
    TributavelTc
};
use FaltaNotas\Enums\TipoContaTc;
use FaltaNotas\Traits\LoggerTraitTc;
// nome do arquivo precisa ser igual ao nome da classe, no meu caso estava o arquivo: ContaInativaExceptionTc mas o nome da classe ContaInativaException, o que fazia com que o autoload nao encontrasse o arquivo de jeito nenhum, pois o arqivo ere ContaInativaExceptionTc e ele estava procutando por ContaInativaException (e assim com os outros arquivos também, namespace precisa bater com o nome original do arquivo) 
use FaltaNotas\Exception\{
    ContaInativaExceptionTc,
    SaldoInsuficienteExceptionTc,
    ValorInvalidoExceptionTc
};

class ContaCorrenteTc extends ContaBancariaTc implements OperacaoBancariaTc, TributavelTc
{
    use LoggerTraitTc;

    private const float TAXA = 0.05;
    private const int LIMITE_EXTRA = 1000;
    static int $limiteExtra = self::LIMITE_EXTRA;

    public function __construct(ClienteTc $cliente, float $saldo)
    {
        parent::__construct($cliente, $saldo, TipoContaTc::CORRENTE);
    }

    public function calcularTaxa(float $valor): float
    {
        return $valor * self::TAXA;
    }

    public function sacar(float $valor): bool
    {
        $saquePermitido = $this->saldo + self::LIMITE_EXTRA;
        $taxaCalculada = $this->calcularTaxa($valor);
        $valorAdescontar = $valor + $taxaCalculada;

        $this->contaInativaException($this->ativa);

        $this->saldoInsuficienteException($valor, $saquePermitido);

        $this->valorInvalidoException($valor);

        // não preciso verificar se o $valor é menor ou igual ao $saquePermitido, pois no if acima verifico se ele é maior, caso for, dispara uma exception e para o sistema, caso não, o saldo é menor ou igual ao $saquePermitido, mantendo o fluxo normal e sacando apenas o valor correto
        if (
            $this->saldo > 0
        ) {
            $this->saldo -= $valorAdescontar;
            $this->log("Saque realizado.");
            return true;
        } else if (
            $valor <= self::$limiteExtra &&
            self::$limiteExtra > 0
        ) {
            $this->log("Saque por limite extra realizado.");
            self::$limiteExtra -= $valor;
            return true;
        } else {
            $this->log("Tentativa de saque fracassada.");
            return false;
        }
    }
}
