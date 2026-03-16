<?php 

function converteCelsiusFahrenheit(float $temperaturaCelsius): float{
	return ($temperaturaCelsius * 9/5) + 32;
}

$temperaturaCelsius = (float) readline("Informe a temperatura em graus Celsius: ");
$temperaturaFahrenheit = converteCelsiusFahrenheit($temperaturaCelsius);

echo "$temperaturaCelsius graus Celsius equivalem a: $temperaturaFahrenheit Fahrenheit.";