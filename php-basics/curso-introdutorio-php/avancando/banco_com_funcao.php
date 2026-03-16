<?php

function sacar(array $conta, float $valor_a_sacar) : array 
{
    if ($conta['Saldo'] < $valor_a_sacar) {
        echo "Você não pode sacar, valor insuficiente." . PHP_EOL;
    } else {
        $conta['Saldo'] -= $valor_a_sacar;
    }
    return $conta;
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

// dizendo que a chave '123.241.453.83' vai receber o retorno da função sacar, ela que recebe a conta '123.241.453.83' como parâmetro e o valor 500 para sacar - onde a função irá
$contasCorrentes['123.241.453.83'] = sacar($contasCorrentes['123.241.453.83'], 500);

echo $contasCorrentes['123.241.453.83']['Saldo'];