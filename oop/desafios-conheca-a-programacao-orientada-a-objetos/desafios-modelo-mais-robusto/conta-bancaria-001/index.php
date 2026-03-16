<?php 
require_once __DIR__ . '/ContaBancaria.php';

$contaUm = new ContaBancaria("Gabriel Erick", 2000);
$contaUm->depositar(1000);
$contaUm->sacar(500);
echo "Saldo atual utilizando método de acesso getter: " . $contaUm->getSaldo() . PHP_EOL;
echo "Titular da conta utilizando método de acesso getter: " . $contaUm->getTitular() . PHP_EOL;
$contaUm->encerrarConta();
$contaUm->sacar(400);

echo "----------------------------------------------------------" . PHP_EOL;

$contaDois = new ContaBancaria("Clara Galle, esteriotipo da minha futura esposa", 40000);
$contaDois->depositar(3000);
$contaDois->sacar(4000);
echo "Saldo atual utilizando método de acesso getter: " . $contaDois->getSaldo() . PHP_EOL;
echo "Titular da conta utilizando método de acesso getter: " . $contaDois->getTitular() . PHP_EOL;
$contaDois->encerrarConta();
$contaDois->depositar(1000);

