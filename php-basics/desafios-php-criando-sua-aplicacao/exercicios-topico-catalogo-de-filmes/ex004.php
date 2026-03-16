<?php 

$a = (int)readline("Digite a quantidade de dias:");
$verificaAnoBissexto = $a == 366 ? "O ano é bissexto." : "O ano não é bissexto.";

echo $verificaAnoBissexto . PHP_EOL;
