<?php

namespace Practice\Conta;

use Practice\Traits\Registravel;

// é uma classe abstrata pois o saque de uma conta corrente e conta poupança são diferentes e eu quero que esta classe "conta" seja apenas um molde para que minhas classes "ContaCorrente" e "ContaPoupanca" possam usar e depois aplicar suas próprias diferenças (nisso já faremos uso de polimorfismo e e herança)
abstract class Conta
{
    use Registravel; // preciso dar um use no arquivo da trait (que se chama Registravel) para que eu tenha acesso aos métodos daquela trait dentro da minha classe

    private static int $contadorId = 0;
    private int $id = 0;
    protected array $historico;
    public function __construct(public readonly int $numero, public readonly string $nome, protected float $saldo)
    {
        // forma correta de acessar uma propriedade estática (que pertence a classe e não a uma instância)
        self::$contadorId += 1;
        $this->id += self::$contadorId;
        $this->historico = [];
    }

    public function depositar(float $valor): bool
    {
        $this->saldo += $valor;
        $this->historico[] = $this->registrarOperacao("Depósito de: ", $valor);

        return true;
    }

    public abstract function sacar(float $valor): bool;

    public function consultarSaldo()
    {
        return $this->saldo;
    }

    public function historico(): array
    {
        return $this->historico;
    }
}
