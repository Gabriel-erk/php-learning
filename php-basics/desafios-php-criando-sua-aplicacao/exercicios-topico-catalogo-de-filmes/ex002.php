<?php 
$n = [];
$nota = 0;

for ($i=0; count($n) < 3; $i++) {
    $n[$i] = readline("Digite a nota " . ($i+1) . ": ");
    $nota += $n[$i];
}

echo "A média das notas é: " . number_format($nota / count($n), 2, ',', '.') . PHP_EOL;