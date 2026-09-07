<?php

use Practice\Conta\{ContaCorrente, ContaPoupanca};

$contas = [];

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
    } elseif($opcao == 2) {
        echo "Informe o número da conta:" . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);

        foreach ($contas as $conta) {
            if ($conta->numero == $numeroConta) {
                $contaProcurada = $conta;

                echo "Informe o valor do depósito:" . PHP_EOL;
                $valor = (float) fgets(STDIN);

                $conta->depositar($valor);
            }
        }        
    }
}
