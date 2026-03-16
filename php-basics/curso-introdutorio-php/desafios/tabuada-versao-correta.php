<?php

/* 
* utilizando intval, converto o retorno de fgets diretamente para número, então, já que ele não é uma string, não faz adição de /n no final, impedindo que fique com o aspecto de quebra de linha após imprimir o número da tabuada
*/
$numero_tabuada = intval(fgets(STDIN));

for ($multiplicador_tabuada = 1; $multiplicador_tabuada <= 10; $multiplicador_tabuada++) { 
    echo "$numero_tabuada X $multiplicador_tabuada = " . $numero_tabuada * $multiplicador_tabuada . PHP_EOL;
}