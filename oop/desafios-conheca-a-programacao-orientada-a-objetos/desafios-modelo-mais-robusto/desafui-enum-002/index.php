<?php 

require_once __DIR__ . '/ContaBancariaSegundoDesafioEnum.php';
require_once __DIR__ . '/ContaSegundoDesafioEnum.php';

$conta = new ContaSegundoDesafioEnum("Gabriel Erick", 20000,ContaBancariaSegundoDesafioEnum::Corrente);

if ($conta->possuiTaxa()) {
    echo "Esta conta possui taxa." . PHP_EOL;
} else {
    echo "Esta conta não possui taxa." . PHP_EOL;
}