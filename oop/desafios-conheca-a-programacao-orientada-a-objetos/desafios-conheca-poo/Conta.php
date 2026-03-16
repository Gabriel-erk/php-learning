<?php

class Conta
{
    private int $saldoEmCentavos;
    private string $nomeTitular;
    private string $numeroConta;

    public function deposito (int $depositoEmCentavos): void{
        if ($depositoEmCentavos > 0) {
            $this->saldoEmCentavos += $depositoEmCentavos;
            echo "Saldo depositado com sucesso!" . PHP_EOL;
            echo "Novo saldo atual: " . $this->saldoEmCentavos  . PHP_EOL;
        }
    }

    public function getSaldoEmCentavos(): int
    {
        return $this->saldoEmCentavos;
    }

    public function saque (int $saqueEmCentavos): int|string {
        if ($saqueEmCentavos > $this->saldoEmCentavos || $saqueEmCentavos < 0) {
            // como especifiquei o tipo de retorno é necessário que em todos os caminhos do if ele encontre a palavra reservada return (mesmo essa abordagem não sendo a melhor, pois eu deveria apenas não retornar nada/exibir mensagem, já que nem faz sentido dar um return no resultado daquela operação no else eu acho)
            return "Valor inválido, tente novamente.";
        } else {
            return $this->saldoEmCentavos -= $saqueEmCentavos;
        }
    }

    public function setNomeTitular(string $nomeTitular): void
    {
        $this->nomeTitular = $nomeTitular;
    }

    public function getNomeTitular(): string
    {
        return $this->nomeTitular;
    }

    public function setNumeroConta(int $numeroConta): void
    {
        $this->numeroConta = $numeroConta;
    }

    public function getNumeroConta(): string
    {
        return $this->numeroConta;
    }
}