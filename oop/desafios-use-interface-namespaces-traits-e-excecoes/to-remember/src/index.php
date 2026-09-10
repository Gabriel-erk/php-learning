<?php

use Practice\Conta\{ContaCorrente, ContaPoupanca};
use Practice\Exceptions\{SaldoInsuficienteException, ValorInvalidoException};

$contas = [];

function encontrarConta(array $contas, int $numeroConta)
{
    echo "Informe o número da conta:" . PHP_EOL;
    $numeroConta = (int) fgets(STDIN);

    foreach ($contas as $conta) {
        if ($conta->numero == $numeroConta) {
            return $conta;
        }
    }
}

while (true) {
    echo "===== BANCO =====";

    echo "1 - Criar conta" . PHP_EOL;
    echo "2 - Depositar" . PHP_EOL;
    echo "3 - Sacar" . PHP_EOL;
    echo "4 - Consultar saldo" . PHP_EOL;
    echo "5 - Aplicar rendimento" . PHP_EOL;
    echo "6 - Ver histórico" . PHP_EOL;
    echo "7 - Calcular taxas" . PHP_EOL;
    echo "0 - Sair" . PHP_EOL;

    echo "Sua opção:";
    $opcao = (int) fgets(STDIN);


    if ($opcao == 1) {
        echo "Informe o número da conta:" . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);
        echo "Informe o seu nome:" . PHP_EOL;
        $nomeConta = (int) fgets(STDIN);
        echo "Informe o saldo inicial da conta:" . PHP_EOL;
        $saldoConta = (int) fgets(STDIN);

        echo "===== TIPO DA CONTA =====" . PHP_EOL;
        echo "Conta Corrente (1)" . PHP_EOL;
        echo "Conta Poupança (2)" . PHP_EOL;

        echo "Sua opção:";
        $tipoConta = (int) fgets(STDIN);

        if ($tipoConta == 1) {
            $contas[] = new ContaCorrente($numeroConta, $nomeConta, $saldoConta);
            echo "Conta corrente criada com sucesso!" . PHP_EOL;
        } elseif ($tipoConta == 2) {
            $contas[] = new ContaPoupanca($numeroConta, $nomeConta, $saldoConta);
            echo "Conta poupança criada com sucesso!" . PHP_EOL;
        } else {
            echo "Tipo de conta inválido." . PHP_EOL;
        }
    } elseif ($opcao == 2) {

        echo "Informe o número da conta:" . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);

        $conta = encontrarConta($contas, $numeroConta);

        echo "Informe o valor do depósito:" . PHP_EOL;
        $valor = (float) fgets(STDIN);

        if ($valor < 0) {
            throw new ValorInvalidoException();
        }

        $conta->depositar($valor);

        echo "Depósito de: $valor realizado com sucesso!";
    } elseif ($opcao == 3) {
        echo "Informe o número da conta:" . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);

        $conta = encontrarConta($contas, $numeroConta);

        echo "Informe o valor do saque:" . PHP_EOL;
        $valor = (float) fgets(STDIN);

        if ($valor > $conta->consultarSaldo()) {
            throw new SaldoInsuficienteException();
        } elseif ($valor < 0) {
            throw new ValorInvalidoException();
        }

        $conta->sacar($valor);

        echo "Saque de: $valor realizado com sucesso!";
    } elseif ($opcao == 4) {
        echo "Informe o número da conta:" . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);

        $conta = encontrarConta($contas, $numeroConta);

        echo "Valor disponível: " . $conta->consultarSaldo() . PHP_EOL;
    } elseif ($opcao == 5) {
        echo "Informe o número da conta poupança: " . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);

        $conta = encontrarConta($contas, $numeroConta);

        if ($conta->consultarSaldo() > 0) {
            $conta->aplicarRendimento();
            echo "Rendimento aplicado com sucesso!" . PHP_EOL;
        } else {
            throw new SaldoInsuficienteException();
        }
    } elseif ($opcao == 6) {
        echo "Informe o número da conta: " . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);

        $conta = encontrarConta($contas, $numeroConta);

        echo "=== HISTÓRICO DE OPERAÇÕES ===" . PHP_EOL;
        foreach ($conta->historico as $operacao) {
            echo $operacao . PHP_EOL;
        }
    } elseif ($opcao == 7) {
        echo "Informe o número da conta corrente: " . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);

        $conta = encontrarConta($contas, $numeroConta);

        echo "O valor da taxa com base em seu saldo é: " . $conta->calculcarTaxa() . PHP_EOL;
    } elseif ($opcao == 0) {
        echo "Obrigado por utiliza o sistema!" . PHP_EOL;
        break;
    } else {
        echo "Opção inválida, tente novamente.";
    }
}
