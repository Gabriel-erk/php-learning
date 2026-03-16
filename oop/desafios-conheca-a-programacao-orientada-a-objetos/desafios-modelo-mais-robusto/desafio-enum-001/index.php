<?php 

require_once __DIR__ . '/ContaBancariaEnum.php';
require_once __DIR__ . '/Conta.php';

$conta = new Conta("Gabriel Erick", 20000);

if ($conta->possuiTaxa(ContaBancariaEnum::Investimento)) {
    echo "Esta conta possui taxa." . PHP_EOL;
} else {
    echo "Esta conta não possui taxa." . PHP_EOL;
}