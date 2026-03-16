<?php

/*
* função que recebe um array de palavras e retorna a quantidade de letras (soma das letras de todas as palavras)
* contar letras de cada palavra
* ir somando a quantidade de letras a cada iteração
* retornar valor total obtido 
*/

function conta_palavras(array $palavras):int
{
    $total_de_letras = 0;
    foreach ($palavras as $palavra) {
        // função realiza a contagem de caracteres dentro de uma string (espaços também contam), e não considera pontuações como um caracter, diferente dá funçaõ strlen() - que caso a string passada seja "água" o retorno será 5 (de 5 caracteres) pois conta a pontuação acima do "á"
        $total_de_letras += mb_strlen($palavra);
    }
    return $total_de_letras;
}

$palavras = [
    "mand",
    "manj",
    "cebo",
    "6água "
];

$total_de_letras = conta_palavras($palavras);

echo $total_de_letras;