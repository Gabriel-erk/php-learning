<?php 

// especificando os tipos de dado das funções e o tipo de dado do retorno
function somarInteiro(int $a, int $b): int{
    return $a + $b;
}

function somarValorPontoFlutuante(float $a, float $b): float{
    return $a + $b;
}

echo "-- Exemplo de soma de valores inteiro --" . PHP_EOL;
echo somarInteiro(10,5) . PHP_EOL;
echo "-- Exemplo de soma de valores ponto flutuante --" . PHP_EOL;
echo somarValorPontoFlutuante(10.5,5.5);
?>