<?php

class ContaCorrente extends ContaBancariaModuloQuatro
{
    public function __construct(string $titular, float $saldo, public readonly int $numeroAgencia)
    {
        return parent::__construct($titular, $saldo);
    }

    public function cobrarTarifaMensal(): void
    {
        $this->saldo -= self::TARIFA_SAQUE;
    }
}
