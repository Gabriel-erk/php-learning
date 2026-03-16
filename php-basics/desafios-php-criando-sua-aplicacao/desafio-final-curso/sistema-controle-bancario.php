<?php

$usuario = [];
$usuario["nome"] = (string) readline("Informe o seu nome:") . PHP_EOL;
$usuario["saldo"] = (float) readline("Informe seu saldo atual:") . PHP_EOL;
$opcaoUsuario = 99;

while ($opcaoUsuario != 4) {
    echo "**********" . PHP_EOL;
    echo "Titular: $usuario[nome]" . PHP_EOL;
    echo "Saldo atual: R\$ $usuario[saldo]" . PHP_EOL;
    echo "**********" . PHP_EOL;

    echo "1. Consultar saldo atual" . PHP_EOL;
    echo "2. Sacar valor" . PHP_EOL;
    echo "3. Depositar valor" . PHP_EOL;
    echo "4. Sair" . PHP_EOL;

    $opcaoUsuario =  (int) readline("Escolha sua opção desejada: ") . PHP_EOL;

    if ($opcaoUsuario == 1) {
        echo "Seu saldo atual é de: R\$ $usuario[saldo]. " . PHP_EOL;
    } elseif ($opcaoUsuario == 2) {
        $valorSaque = (float) readline("Digite o valor a sacar: ");
        if ($valorSaque > $usuario["saldo"]) {
            echo "Saldo insuficiente." . PHP_EOL;
        } else {
            echo "Saque realizado com sucesso!" . PHP_EOL;
            $usuario["saldo"] -= $valorSaque;
        }
    } elseif ($opcaoUsuario == 3) {
        $valorDeposito = (float) readline("Digite o valor a depositar: ") . PHP_EOL;
        $usuario["saldo"] += $valorDeposito;
        echo "Depósito realizado com sucesso!" . PHP_EOL;
    } elseif ($opcaoUsuario == 4) {
        echo "Volte sempre.";
    } else {
        echo "Opção inválida, tente novamente." . PHP_EOL;
    }
}