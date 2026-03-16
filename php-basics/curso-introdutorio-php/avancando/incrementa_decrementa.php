<?php

function adiciona_dois($x) {
    return $x + 2;
}

// váriavel está recebendo o retorno da função, no caso, a soma do número passado como parâmetro com o valor 2, já que está com o comando return, sinalizando que quero RETORNAR algum valor quando a função for chamada
$resultado = adiciona_dois(15);

echo $resultado . PHP_EOL;

function menos_um($valor) {
    return $valor - 1;
}

// pode-se apenas exibir o resultado de uma função com o echo, já que, como é uma função, ela possui um retorno
echo menos_um(10);