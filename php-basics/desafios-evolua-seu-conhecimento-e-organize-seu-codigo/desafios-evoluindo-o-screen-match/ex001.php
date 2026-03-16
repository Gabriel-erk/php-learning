<?php

function miniCalculadora(string $operacaoMatematica, int $num1, int $num2): float|int
{
	// passei a responsabilidade da verficiação para dentro da função
	// criando um array com as opções válidas e realizando o loop para verificação aqui na função
	$opcoesValidas = ["soma", "subtracao", "divisao", "multiplicacao", "módulo", "potência"];

	// Validação da operação matemática, onde a função in_array verifica se o valor
	// informado pelo usuário está contido no array $opcoesValidas, caso esteja, retorna true, se não, false.
	// e ele está em um while para continuar pedindo até que o usuário informe um valor válido.
	while (in_array($operacaoMatematica, $opcoesValidas) === false) {
		$operacaoMatematica = (string) readline("Operação inválida! Informe a operação matemática: ");
	}
	return match ($operacaoMatematica) {
		"soma" => $num1 + $num2,
		"subtracao" => $num1 - $num2,
		"divisao" => $num1 / $num2,
		"multiplicacao" => $num1 * $num2,
		"módulo" => $num1 % $num2,
		"potência" => $num1 ** $num2,
	};
}

$opcaoUsuario = (string) readline("Informe a operação matemática: ");

$valorUmUsuario = (int) readline("Informe o primeiro valor a ser calculado: ");
$valorDoisUsuario = (int) readline("Informe o segundo valor a ser calculado: ");

$resultadoOperacao = miniCalculadora($opcaoUsuario, $valorUmUsuario, $valorDoisUsuario);
echo "O resultado da operação é: " . $resultadoOperacao . PHP_EOL;
