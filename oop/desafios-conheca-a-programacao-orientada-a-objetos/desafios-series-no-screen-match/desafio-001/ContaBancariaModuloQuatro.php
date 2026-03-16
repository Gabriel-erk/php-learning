<?php


class ContaBancariaModuloQuatro
{
    public const TARIFA_SAQUE = 2.50;

    public function __construct(public readonly string $titular, public readonly float $saldo) {}

    public function depositar(float $valorDeposito): bool
    {
        if ($valorDeposito > 0) {
            $this->saldo += $valorDeposito;
            return true;
        } else {
            return false;
        }
    }

    public function sacar(float $valorSaque): bool
    {
        // self me permite acessa atributos da própria classe (a constante eu não consigo acessar com this, pois uma constante não é igual a um atributo)
        $valorSaqueComTarifa = $valorSaque + self::TARIFA_SAQUE;
        if ($valorSaqueComTarifa > 0 && $valorSaqueComTarifa <= $this->saldo) {
            $this->saldo -= $valorSaqueComTarifa;
            return true;
        } else {
            return false;
        }
    }

    // método desnecessário pois já é possivel consultar o valor do saldo diretamtene pelo atributo saldo, mas estou definindo este método a pedido do exercicio
    public function consultarSaldo(): float
    {
        return $this->saldo;
    }
}
