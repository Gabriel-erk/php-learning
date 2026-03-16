<?php

$array = [
    1 => 'a', // chave 1 com o valor A
    '1' => 'b', // chave '1' foi convertida para chave 1 pois caso uma string tenha apenas números o php converte para um número inteiro, ex: '8' será convertido para 8, e nesse caso na hora de imprimir será imprimido o valor 'b' pois '1' foi convertido para 1, e como já tinhamos uma chave atribuida como 1, o '1' convertido subscreveu o 1 declarado antes com o valor de a
    1.5 => 'c', // chave 1.5, porém arrays associativos em php só aceitam valores inteiros ou strings como chave (strings possuem a exceção de conversão citada acima), então ele irá CORTAR a parte decimal deste float, ou seja 1.5 será convertido para 1, subscrevendo o valor de '1' convertido para 1 no índice anterior
    true => 'd' // chave true, porém, lembrando, os tipos de chave permitidos são inteiros e strings, então, este também será convertido, como é true, será convertido para o valor 1 (caso fosse false, converteria para 0) assim, sobscrevendo mais uma vez o valor no índice anterior que também foi convertido para 1, fazendo com que, na impressão do array abaixo, seja imprimido APENAS o valor do último índice, no caso, índice 1, com o valor 'd', pois ele sobscreveu todos os índices anteriores, como a linguagem não permite índices iguais, e prevalerecerá o ÚLTIMO com o valor igual aos anteriores, apenas esse será impresso (como se só ele existisse no array, pois como o resto foi sobscrito, é como se tivessem sido "apagados"w)
];

foreach ($array as $item) {
    echo $item;
}