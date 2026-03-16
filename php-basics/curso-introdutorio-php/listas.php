<?php

$idades = [20, 30, 91, 14, 10, 87];

// ele adiciona o índice sozinho, adiciona na próxima posição vazia
$idades[] = 35;

echo "Idade adicionada ao array = $idades[6]" . PHP_EOL;

$umaIdade = $idades[5];

echo "Idade do índice 5 = $umaIdade";