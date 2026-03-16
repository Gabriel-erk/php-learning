<?php 


class Conta 
{
    public function __construct(public readonly string $titular, public readonly float $saldo)
    {
    }

    public function possuiTaxa(ContaBancariaEnum $contaBancaria): bool{
        if ($contaBancaria == ContaBancariaEnum::Corrente || $contaBancaria == ContaBancariaEnum::Investimento) {
            return true;
        } else {
            return false;
        }
    }
}
