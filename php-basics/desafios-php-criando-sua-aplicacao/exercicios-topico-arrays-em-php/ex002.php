<?php 

$contador = 0;
$x = [];
while ($contador < 4) {
    // o ++ aqui é pós-incremento, ou seja, ele utiliza o valor atual de $contador na expressão e depois incrementa o valor da variável em 1, então na primeira iteração, ele vai pedir a nota 1 (pois o valor atual de $contador é 0) e depois incrementar $contador para 1, na segunda iteração, ele vai pedir a nota 2 (pois o valor atual de $contador é 1) e depois incrementar $contador para 2, e assim por diante.
    $x[$contador++] = (float) readline("Digite a nota " . $contador . ": ");
}

$media = array_sum($x) / count($x);
if ($media > 6) {
    echo "Aluno aprovado com média: $media" . PHP_EOL;
} else {
    echo "Aluno reprovado com média: $media" . PHP_EOL;
}

var_dump($x);