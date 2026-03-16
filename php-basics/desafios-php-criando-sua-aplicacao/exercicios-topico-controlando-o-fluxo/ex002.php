<?php 

$peso = $argv[1];
$altura = (float)$argv[2];
$imc = $peso / ($altura * $altura);

if ($imc < 18.5) {
    echo "Seu IMC é $imc e você está abaixo do peso." . PHP_EOL;
} elseif ($imc >= 18.5 and $imc < 25) {
    echo "Seu IMC é $imc e você está com o peso ideal." . PHP_EOL;
} elseif ($imc >= 25 and $imc < 30) {
    echo "Seu IMC é $imc e você está com sobrepeso." . PHP_EOL;
} elseif ($imc >= 30 and $imc < 40) {
    echo "Seu IMC é $imc e você está com obesidade." . PHP_EOL;
} else {
    echo "Seu IMC é $imc e você está com obesidade mórbida." . PHP_EOL;
}