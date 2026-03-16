<?php
class ContaBancaria
{
    private bool $ativa;
    public function __construct(private Cliente $cliente, private float $saldo)
    {
        $this->ativa = true;
    }

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function verificaAtividade(): bool
    {
        return $this->ativa;
    }

    public function deposito(float $valorDeposito): bool
    {
        if ($this->verificaAtividade() && $valorDeposito > 0) {
            $this->saldo += $valorDeposito;
            return true;
        } else {
            return false;
        }
    }

    public function saque(float $valorSaque): bool
    {
        if ($this->verificaAtividade() && $valorSaque > 0 && $valorSaque <= $this->saldo) {
            $this->saldo -= $valorSaque;
            return true;
        } else {
            return false;
        }
    }

    public function encerrarConta(): bool
    {
        if ($this->verificaAtividade()) {
            $this->ativa = false;
            return true;
        } else {
            return false;
        }
    }
}
