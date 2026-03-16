<?php

// fgets pega o dado que o usuário inseriu e adiciona um /n (uma quebra de linha, por isso quando vou realizar a exibição do meu código o número inserido pelo usuário fica em uma linha e o restante do código(do texto dentro do echo) fica na linha de baixo), o método trim remove espaços do começo e do final de uma string o que inclui: Espaços ( ), Quebra de linha (\n), Tabulação (\t), Retorno de carro (\r), no meu caso o fgets lê o número digitado e adiciona o \n (quebra de linha), o trim remove essa quebra
$numero_tabuada = trim(fgets(STDIN));

for ($multiplicador_tabuada = 1; $multiplicador_tabuada <= 10; $multiplicador_tabuada++) { 
    echo "$numero_tabuada X $multiplicador_tabuada = " . $numero_tabuada * $multiplicador_tabuada . PHP_EOL;
}