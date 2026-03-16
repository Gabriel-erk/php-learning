<?php

/*
* script que converte a temperatura em celsiu para fahrenheit através de uma função
* pedir temperatura ao usuário (será considerada como padrão em celsius)
* realizar a conversão do valor passado para fahrenheit através da fórmula (pesquisar no google)
 */

function converte_temperatura_para_fheit(int $temperatura_celsius):float
{
    $temperatura_convertida_fheit = $temperatura_celsius * 1.8 + 32;
    return $temperatura_convertida_fheit;
}

echo "Digite a temperatura atual: " . PHP_EOL;
$temperatura_atual = intval(fgets(STDIN));

$temperatura_atual = number_format(converte_temperatura_para_fheit($temperatura_atual), 2,'.',' ');

echo "A temperatura em Fahrenheint é: $temperatura_atual F." . PHP_EOL;