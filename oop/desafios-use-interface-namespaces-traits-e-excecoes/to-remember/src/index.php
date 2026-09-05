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
        echo "Conta Corrente (1)" . PHP_EOL;
        echo "Conta Poupança (2)" . PHP_EOL;

        echo "Sua opção:";
        $tipoConta = (int) fgets(STDIN);

        if ($tipoConta == 1) {
        } elseif ($tipoConta == 2) {
            # code...
        } else {
            echo "Tipo de conta inválido.";
        }
        // $conta = new ContaCorrente();
    }
}
