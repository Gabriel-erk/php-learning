<?php

$idades = [10, 98, 56, 32, 21, 87, 89, 87];

// count devolve a quantidade de itens de um array
echo count($idades) . PHP_EOL;

for ($i=0; $i < count($idades); $i++) { 
    echo $idades[$i] . PHP_EOL;
}