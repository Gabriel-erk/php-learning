<?php

namespace Practice\Conta;

use Practice\Exceptions\{SaldoInsuficienteException, ValorInvalidoException};
use Practice\Traits\Registravel;

// é uma classe abstrata pois o saque de uma conta corrente e conta poupança são diferentes e eu quero que esta classe "conta" seja apenas um molde para que minhas classes "ContaCorrente" e "ContaPoupanca" possam usar e depois aplicar suas próprias diferenças (nisso já faremos uso de polimorfismo e e herança)
abstract class Conta
{
    use Registravel; // preciso dar um use no arquivo da trait (que se chama Registravel) para que eu tenha acesso aos métodos daquela trait dentro da minha classe

    private static int $contadorId;
    private int $id;
    public function __construct(public readonly int $numero, public readonly string $nome, protected float $saldo) {
        $this->contadorId += 1;
        $this->id += $this->contadorId;
    }

    public function depositar(float $valor): bool|ValorInvalidoException
    {
        if ($valor > 0) {
            $this->saldo += $valor;
            $this->registrarOperacao("Depósito de: $valor realizado com sucesso!");

            return true;
        } else {
            throw new ValorInvalidoException();
        }
    }

    public abstract function sacar(float $valor): bool|ValorInvalidoException|SaldoInsuficienteException;

    public function consultarSaldo()
    {
        return $this->saldo;
    }
}
