<?php 

class ContaBancariaServiceDesafioChat 
{
    public function depositar(ContaBancariaDesafioChat $conta, float $valor): string{
        if ($conta->depositar($valor)) {
            return "Deposito na conta do cliente: " . $conta->cliente->nome . ", foi efetuada com sucesso!";
        } else {
            return "Deposito na conta do cliente: " . $conta->cliente->nome . ", não foi efetudada com sucesso, por favor verifique se conta está ativa ou se o saldo é menor ou equivalente a zero.";
        }
    }

    public function sacar(ContaBancariaDesafioChat $conta, float $valor): string{
        if ($conta->sacar($valor)) {
            return "Saque na conta do cliente: " . $conta->cliente->nome . ", foi realizada com sucesso!";
        } else {
            return "Saque na conta do cliente: " . $conta->cliente->nome . ", não foi realizada com sucesso, por favor verificar se conta está ativa, saque não foi maior que o saldo disponível ou maior que o limite de saque de R$ " . $conta::LIMITE_SAQUE_PADRAO . ".";
        }
    }

    public function desativarConta(ContaBancariaDesafioChat $conta): string{
        if ($conta->desativarConta()) {
            return "Conta do cliente: " . $conta->cliente->nome . ", desativada com sucesso!";
        } else {
            return "Conta do cliente: " . $conta->cliente->nome . ", não foi desativada com sucesso, por favor verificar se já não está desativada ou o saldo é diferente de 0.";
        }
    }

    public function estaAtiva(ContaBancariaDesafioChat $conta): string{
        if ($conta->estaAtiva()) {
            return "Conta do cliente: " . $conta->cliente->nome . ", está ativa.";
        } else {
            return "Conta do cliente: " . $conta->cliente->nome . ", não está ativa.";
        }
    }
}
