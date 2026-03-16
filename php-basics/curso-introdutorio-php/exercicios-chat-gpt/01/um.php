<?php

// função que recebe array de números inteiros e retorne a soma de todos os elementos, com foreach

function soma_numeros_array (array $array_inteiros) : int 
{
    $soma_array_inteiros = 0;
    foreach ($array_inteiros as $inteiro) {
        $soma_array_inteiros += $inteiro;
    }
    return $soma_array_inteiros;
}

$array_numeros_inteiros_aleatorios = [
    10,
    20,
    30,
    // 879,
    // 550,
];

echo soma_numeros_array($array_numeros_inteiros_aleatorios);