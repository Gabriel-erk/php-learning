<?php
require_once __DIR__ . '/Cliente.php';
require_once __DIR__ . '/ContaBancaria.php';

$cliente = new Cliente("Gabriel Erick", "588.888.341-79");
$contaBancaria = new ContaBancaria($cliente, 2000);

if ($contaBancaria->deposito(2000)) {
    echo "Deposito realizado na conta do cliente: " . $cliente->getNome() . " - Saldo atual: " . $contaBancaria->getSaldo() . PHP_EOL;
} else {
    echo "conta inativa ou valor invalido para depósito" . PHP_EOL;
}

if ($contaBancaria->saque(300)) {
    echo "Saque realizado na conta do cliente: " . $cliente->getNome()  . " - Saldo atual: " . $contaBancaria->getSaldo() . PHP_EOL;
} else {
    echo "conta inativa ou valor de saque invalido" . PHP_EOL;
}

if ($contaBancaria->encerrarConta()) {
    echo "Conta do cliente: " . $cliente->getNome() . " foi encerrada com sucesso." . PHP_EOL;
} else {
    echo "conta já se encontra inativa." . PHP_EOL;
}

if ($contaBancaria->deposito(100)) {
    echo "Deposito realizado na conta do cliente: " . $cliente->getNome() . " - Saldo atual: " . $contaBancaria->getSaldo() . PHP_EOL;
} else {
    echo "conta inativa ou valor invalido para depósito" . PHP_EOL;
}
