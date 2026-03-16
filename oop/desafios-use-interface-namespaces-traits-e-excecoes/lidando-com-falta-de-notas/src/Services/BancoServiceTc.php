<?php

namespace FaltaNotas\Services;

use FaltaNotas\Model\ContaBancariaTc;

class BancoServiceTc
{
    private array $contas;
    /** @var ContaBancariaTc */
    // comentário acima indica pra IDE que a propriedade $contas vai ter apenas objetos do tipo ContaBancariaTc

    public function criarConta(ContaBancariaTc $conta): string
    {
        $this->contas[] = $conta;
        return "Conta criada com sucesso \n";
    }

    public function getSaldo(ContaBancariaTc $conta): string
    {
        return "Saldo atual da conta " . $conta->getTipo()->name . " = R$ " . $conta->getSaldo() . "\n";
    }

    public function depositar(ContaBancariaTc $conta, float $valor): string
    {
        try {
            if ($conta->depositar($valor)) {
                return "Depósito de: $valor realizado com sucesso na conta " . $conta->getTipo()->name . " do cliente " . $conta->getCliente() . "\n";
            } else {
                return "Tentativa de depósito não efetuada na conta " . $conta->getTipo()->name . " do cliente " . $conta->getCliente() . "\n";
            }
        } catch (\Throwable $th) {
            return "Erro/Exception depósito: " . $th->getMessage() . "\n";
        }
    }

    public function sacar(ContaBancariaTc $conta, float $valor): string
    {
        try {
            if ($conta->sacar($valor)) {
                return "Saque de: $valor realizado com sucesso na conta " . $conta->getTipo()->name . " do cliente " . $conta->getCliente() . "\n";
            } else {
                return "Tentativa de saque não efetuada na conta " . $conta->getTipo()->name . " do cliente " . $conta->getCliente() . "\n";
            }
        } catch (\Throwable $th) {
            return "Erro/Exception saque: " . $th->getMessage() . "\n";
        }
    }

    public function transferir(ContaBancariaTc $contaOrigem, ContaBancariaTc $contaDestino, float $valor): string
    {
        try {
            if (
                $contaOrigem->sacar($valor) &&
                $contaDestino->depositar($valor)
            ) {
                return "Transferência de: $valor realizada com sucesso de conta " . $contaOrigem->getTipo()->name . " do cliente " . $contaOrigem->getCliente() . " para conta " . $contaDestino->getTipo()->name . " do cliente " . $contaDestino->getCliente() . "\n";
            } else {
                return "Tentativa de transferência de valores entre contas fracassada.\n";
            }
        } catch (\Throwable $th) {
            return "Erro/Exception: " . $th->getMessage();
        }
    }

    public function listarContas(): void
    {
        echo "=== Listando contas === \n";
        foreach ($this->contas as $conta) {
            echo "Tipo da conta: " . $conta->getTipo()->name . "\n";
            echo "Nome cliente: " . $conta->getCliente() . "\n";
            echo "Saldo atual: " . $conta->getSaldo() . "\n";
            echo "ID: " . $conta->getId() . "\n";
            if ($conta->getStatus()) {
                echo "Status: ATIVA \n";
            } else {
                echo "Status: DESATIVADA \n";
            }
            echo "============ \n";
        }
    }

    public function totalDinheiroBanco(): string
    {
        $somaDinheiroBanco = 0;
        foreach ($this->contas as $conta) {
            $somaDinheiroBanco += $conta->getSaldo();
        }
        return "Saldo total do banco no dia: " . date('d/m') . " é R\$ $somaDinheiroBanco \n";
    }


    public function getContas(): array
    {
        return $this->contas;
    }

    public function desativar(ContaBancariaTc $conta): string
    {
        if ($conta->desativar()) {
            return "Conta " . $conta->getTipo()->name . " do cliente " . $conta->getCliente() . " desativada com sucesso. \n";
        } else {
            return "Conta " . $conta->getTipo()->name . " do cliente " . $conta->getCliente() . " não foi desativada. \n";
        }
    }
}
