<?php

class ContaSegundoDesafioEnum
{
    public function __construct(public readonly string $titular, public readonly float $saldo, public readonly ContaBancariaSegundoDesafioEnum $tipo) {}

    public function possuiTaxa(): bool{
        if ($this->tipo == ContaBancariaSegundoDesafioEnum::Corrente || $this->tipo == ContaBancariaSegundoDesafioEnum::Investimento) {
            return true;
        } else {
            return false;
        }
    }

}
