<?php 

$notas = [];

// pegando 4 notas do usuário
for($i = 0; $i < 4; $i++){
    $notas[] = readline("Informe o valor da nota " . ($i + 1) . " ");
}

array_unique($notas); // remove valores duplicados do array
rsort($notas);  // ordena o array em ordem decrescente (r de reverso), a maior nota fica na posição 0 e assim em diante
echo "As maiores notas são: $notas[0], $notas[1], $notas[2]" . PHP_EOL;

