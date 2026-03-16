<?php 

function calculaImc(float $peso, float $altura): float {
	return $peso / ($altura * $altura);
}

$pesoUsuario = (float) readline("Informe seu peso em quilogramas: ");
$alturaUsuario = (float) readline("Informe sua altura em centímetros: ");

$imcUsuario = number_format(calculaImc($pesoUsuario, $alturaUsuario), 2, ',', '.');

echo "Seu IMC é: $imcUsuario";