<?php 

class ContaCorrenteDesafioChat extends ContaBancariaDesafioChat
{
    public const float TAXA_MANUTENCAO = 400;
    public function __construct(ClienteDesafioChat $cliente, float $saldo) {
        parent::__construct($cliente, $saldo);
    }

    // sobrescrevendo método saque da classe pai
    public function sacar(float $valor): bool{
        if ($valor > 0 && $valor <= $this->saldo && $valor <= $this->saldo + self::LIMITE_SAQUE_PADRAO) {
            if (($this->saldo - self::TAXA_MANUTENCAO) > 0) {
                $this->saldo -= self::TAXA_MANUTENCAO + $valor;
                return true;
            }
            $this->saldo -= $valor;
            return true;
        } else {
            return false;
        }
    }
}
