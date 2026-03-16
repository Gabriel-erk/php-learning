<?php
namespace MaisOrganizacao\Model;

use MaisOrganizacao\Model\Trait\ValidacaoFinanceiraTb;

abstract class ContaBancariaTb implements OperacoesBancariasTb
{
    // usando nossa trait para permitir que essa classe e as classes filhas tenham acesso aos métodos presentes nela
    use ValidacaoFinanceiraTb;
    // definindo nossa constante publica com o valor de 10000, na nossa regra de negocio, ela será o valor fixo que teremos como padrão definindo o limite que um cliente pode sacar de uma vez, como é uma constante, não precisa de readonly, pois os valores de constantes não podem ser modificados e está como um atributo público pois quero que seja possivel acessa-lo de diferentes arquivos do sistema, já que, como será apenas visto (seu valor não sera alterado), é irrelevante aplicar uma regra complicada apenas para ser visto por poucos/um arquivo
    public const LIMITE_SAQUE_PADRAO_TB = 10000;
    protected bool $ativa;
    public function __construct(public readonly ClienteTb $cliente, protected float $saldo, public readonly TipoContaTb $tipoConta)
    {
        $this->ativa = true;
    }

    public function estaAtiva(): bool
    {
        return $this->ativa;
    }

    public function desativar(): bool
    {
        if ($this->validarContaAtiva($this->ativa) && $this->validarValorPositivo($this->saldo)) {
            $this->ativa = false;
            return true;
        } else {
            return false;
        }
    }

    public function depositar(float $valor): bool
    {
        if ($this->validarContaAtiva($this->ativa) && $this->validarValorPositivo($valor)) {
            $this->saldo += $valor;
            return true;
        } else {
            return false;
        }
    }

    abstract public function sacar(float $valor): bool;

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}
