<?php

// isso no caso é uma subRotina é quando não se retorna um valor
function sacar($valor_saque, $contas){
    foreach ($contas as $conta) {
        if ($conta['Saldo'] < $valor_saque) {
            echo $conta['Titular'] . " não pode sacar, saldo insuficiente." . PHP_EOL;
        } else {
            $conta['Saldo'] -= $valor_saque;
            echo  $conta['Titular'] . " sacou: $valor_saque." . PHP_EOL;
            echo "Saldo restante: " . $conta['Saldo'] . PHP_EOL;
        }
    }
}

$contasCorrentes = [
    '123.445.123-98' => [
        'Titular' => 'Hylander Comédia',
        'Saldo' => 87631
    ],
    
    '123.433.451-93' => [
        'Titular' => 'Marco Dos Anjos',
        'Saldo' => -98765
    ],
    
    '123.241.453.83' => [
        'Titular' => 'Fulano de tal',
        'Saldo' => 389778
    ]
];

echo "Digite o valor que deseja sacar: ";
$valor_a_sacar = floatval(fgets(STDIN));

sacar($valor_a_sacar, $contasCorrentes);