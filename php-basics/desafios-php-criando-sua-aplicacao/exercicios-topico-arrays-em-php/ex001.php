<?php 

$teste = [10,1000,1000,80,80,40,40,50,50];

// percorro o array teste
for ($i=0; $i < count($teste); $i++) { 
    // percorro o array teste novamente pois quero que um valor seja comparado com todos os outros valores do array
    for ($j=0; $j < count($teste); $j++) { 
        // comparo se o valor do índice i é igual ao valor do índice j e se os índices são diferentes (para não comparar o mesmo valor com ele mesmo)
        if ($teste[$i] == $teste[$j] && $i != $j) {
            // se a condição for verdadeira, removo o valor duplicado do array utilizando a função unset(), que remove o elemento do array, mas mantém os índices originais, por isso utilizo a função array_values() no final para reindexar o array e deixar os índices sequenciais
            unset($teste[$j]);
            // faço isso a cada vez que remover um valor duplicado, para garantir que ele consiga fazer a remoção corretamente, já que, ao remover um valor, os índices do array ficam "quebrados", e acaba não tendo o valor esperado na próxima iteração
            // Resultado caso não reorganize os indices:Comparações são puladas, Alguns duplicados não são verificados ,Parece que o código “falha aleatoriamente”
            // pelo visto no meu caso ele estava pulando algumas comparações, então para garantir que todas as comparações sejam feitas corretamente, eu reindexo o array a cada remoção de valor duplicado
            $teste = array_values($teste);
        }
    }
}

// array values serve para reindexar o array, ou seja, para que os índices fiquem sequenciais (0,1,2,3...) após a remoção dos valores duplicados, pois ao utilizar o unset(), os índices originais são mantidos, o que pode causar problemas ao percorrer o array posteriormente
foreach ($teste as $valor) {
    echo $valor . PHP_EOL;
}
var_dump(array_values($teste));