<?php

namespace FaltaNotas\Model;
// namespace das interfaces que usarei
use FaltaNotas\Contracts\{LogavelTc, OperacaoBancariaTc};
// namespace dos enums
use FaltaNotas\Enums\TipoContaTc;
use FaltaNotas\Traits\{IdentificadorTraitTc, LoggerTraitTc, DisparaExceptionTc};

abstract class ContaBancariaTc implements OperacaoBancariaTc, LogavelTc
{
    // usando as traits (é necessário colocar o namespace completo e preciso chamar dentro do corpo da classe, como boa prática, antes do construtor e definição de propriedades)
    use IdentificadorTraitTc;
    use LoggerTraitTc;
    use DisparaExceptionTc;

    private int $id;
    protected bool $ativa;
    // Classe ClienteTc está no namespace FaltaNotas\Model TAMBÉM então não precisa de use
    public function __construct(protected ClienteTc $cliente, protected float $saldo, protected TipoContaTc $tipoConta)
    {
        $this->id = $this->defineId();
        $this->ativa = true;
    }

    /* 
    * valor > 0
    * conta ativa
    * adiciona saldo se 2 condições acima são true
    * retorna um valor booleano e usa método log para registrar ação
    */
    public function depositar(float $valor): bool
    {
        $this->contaInativaException($this->ativa);
        // tentei aplicar o método de valorInvalido, mas se fizesse isso, não teria meu else para registrar o log de fracasso
        if (
            $valor > 0
        ) {
            $this->saldo += $valor;
            // acessamos o método log que pertence a nossa trait com this, não é necessário instância nem nada
            $this->log("Depósito realizado.");
            return true;
        } else {
            $this->log("Tentativa de depósito fracassada.");
            return false;
        }
    }
    // cada conta implementa sua regra de saque, apenas tenho que garantir que este método irá existir em todas as classes filhas de ContaBancariaTc (por mais que na interface esteja que o método tem o modificador de acesso publico, aqui posso alterar para abstrato, não preciso de uma implementação de método de nenhuma das minhas interfaces pois este método é abstrato, o importante é a assinatura do método ser como a da interface (ex: sacar, parâmetros, retorno etc))
    abstract function sacar(float $valor): bool;

    public function desativar(): bool
    {
        if (
            $this->ativa &&
            $this->saldo == 0
        ) {
            $this->ativa = false;
            $this->log("Conta desativada.");
            return true;
        } else {
            $this->log("Tentativa de desativação de conta fracassada.");
            return false;
        }
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function getCliente(): string
    {
        return $this->cliente->nome;
    }

    public function getTipo(): TipoContaTc
    {
        return $this->tipoConta;
    }

    public function getStatus(): bool {
        return $this->ativa;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
