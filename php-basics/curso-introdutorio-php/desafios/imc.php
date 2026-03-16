<?php

$peso = floatval(fgets(STDIN));
$altura = floatval(fgets(STDIN));

$imc = $peso / $altura**2;

if ($imc < 18.5) {
    echo "baixo peso.";
} else if($imc >= 18.5 && $imc <= 24.9){
    echo "peso normal.";
} else if ($imc > 25 && $imc <= 29.99) {
    echo "sobrepeso.";
} else {
    echo "obesidade.";
}


// echo "Seu IMC é: " . number_format($imc, 2, '.', '');
