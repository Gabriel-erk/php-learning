<?php

abstract class ContaBancariaDesafioChat
{
    private bool $ativa;
    public const float LIMITE_SAQUE_PADRAO = 10000; // obviamente um readonly não funciona em uma constante KKKKKK, seu valor não pode ser trocado né jegue
    // ela sendo protected permite que ela não seja instanciada diretamente pois só é possível realizar uma instãncia/contexto de uma instancia seria no arquivo de execução, e o protected permite que este construtor apenas seja acessado pelas classes filhas dessa
    // obs: modificador do construct foi alterado de protected para public devido a reformulação do chat no exercicio
    // não coloquei como privado pois public + readonly terão um efeito mais efetivo e evitando getters e setters
    public function __construct(public readonly ClienteDesafioChat $cliente, protected float $saldo)
    {
        $this->ativa = true;
    }

    public function getSaldo(): float{
        return $this->saldo;
    }

    public function estaAtiva(): bool
    {
        return $this->ativa;
    }

    public function depositar(float $valor): bool
    {
        if (!$this->estaAtiva() || $valor <= 0) {
            // se a conta não estiver ativa (ou seja, se !$this->estaAtiva() for false, ou o valor for menor ou igual a zero, vai retornar false e não vai depositar)
            return false;
        } else {
            $this->saldo += $valor;
            return true;
        }
    }

    public function desativarConta(): bool
    {
        if ($this->ativa == false || $this->saldo != 0) {
            // retorna false pois uma das condições acima é verdade (atributo ativa já é false, ou seja, conta já está desativada, OU o saldo é diferente de 0, pois se tiver algum valor (ou seja, $this->saldo != 0 retornar false) irá entrar nesse bloco de if), em um desses casos retornará falso, pois a ação de "desativar conta" não foi realizada
            return false;
        } else {
            // caso contrário da situação acima, defino a conta como "inativa" e retorno true pois o ato de "desativar conta" foi concluido
            $this->ativa = false;
            return true;
        }
    }

    // metódo que será sobreescrito nas classes filhas e já que cada conta vai ter suas próprias regras de saque, então esse método aqui não terá implementação, apenas a assinatura do método (assinatura = nome do método + parâmetros + tipo de retorno) e obviamente será abstrato, pois não terá implementação aqui na classe mãe
    public abstract function sacar(float $valor): bool;
}
