<?php

require_once __DIR__ . '/ClienteTa.php';
require_once __DIR__ . '/ContaBancariaTa.php';
require_once __DIR__ . '/TipoContaTa.php';
require_once __DIR__ . '/ContaCorrenteTa.php';
require_once __DIR__ . '/ContaPoupancaTa.php';
require_once __DIR__ . '/ContaBancariaServiceTa.php';

$cliente = new ClienteTa("Gabriel Erick", "897.088.087-98");
// aqui quando realizar o saque vai descontar uma taxa de 400
$contaCorrente = new ContaCorrenteTa($cliente, 14000);
$contaPoupanca = new ContaPoupancaTa($cliente, 23000);
$contaBancariaService = new ContaBancariaServiceTa();

echo "==== ATIVAÇÃO INICIAL ====" . PHP_EOL;
echo "Status 1: " . $contaBancariaService->status($contaCorrente) . PHP_EOL;
echo "Status 2: " . $contaBancariaService->status($contaPoupanca) . PHP_EOL;
echo "\n";
echo "==== DEPÓSITOS VÁLIDOS ====" . PHP_EOL;
echo $contaBancariaService->depositar($contaCorrente, 400) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo "\n";
echo $contaBancariaService->depositar($contaPoupanca, 2000) . PHP_EOL;
echo $contaBancariaService->saldo($contaPoupanca) . PHP_EOL;
echo "\n";
echo "==== DEPÓSITOS INVÁLIDOS ====" . PHP_EOL;
// depositar em ambas as contas é a mesma coisa - testando depósito em ambas com saldo negativo - porém o comportamento vai ser sempre o mesmo independente da conta, para este método elas não tem particularidades como o saque por exemplo, logo, realizando o teste apenas em 1, obterei o mesmo resultado
echo $contaBancariaService->depositar($contaCorrente, -1) . PHP_EOL;
echo $contaBancariaService->depositar($contaPoupanca, -1) . PHP_EOL;
echo "\n";
// deixando saldo da conta negativo para desativar a conta e poder testar um saque assim
echo $contaBancariaService->sacar($contaCorrente, 10000) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo $contaBancariaService->sacar($contaCorrente, 3600) . PHP_EOL; // restou 4000, porém não consigo sacar 4000 pois preciso pedir um valor menor, devido a taxa de 400, atingirá o valor que quero de 4000 (pois 3600 + 400 que será removido da taxa, 4000)
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo "\n";
// desativando conta
echo $contaBancariaService->desativar($contaCorrente) . PHP_EOL;
echo "\n";
// realizando saque com conta desativada
echo $contaBancariaService->depositar($contaCorrente, 400) . PHP_EOL;
// reativando conta e depositando valor para prosseguir com testes
echo $contaBancariaService->ativar($contaCorrente) . PHP_EOL;
echo $contaBancariaService->depositar($contaCorrente, 14400) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo "\n";

echo "==== SAQUES VÁLIDOS + SAQUE POLIMÓRFICO ====" . PHP_EOL;
/* 
* saque em conta corrente
*/
echo $contaBancariaService->sacar($contaCorrente, 500) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo "\n";
/* 
* saque em conta poupança
*/
echo $contaBancariaService->sacar($contaPoupanca, 400) . PHP_EOL;
echo $contaBancariaService->saldo($contaPoupanca) . PHP_EOL;
echo "\n";

echo "==== SAQUES INVÁLIDOS + SAQUE POLIMÓRFICO ====" . PHP_EOL;
/* 
* teste em conta corrente
*/
// colocando valor negativo
echo $contaBancariaService->sacar($contaCorrente, -1) . PHP_EOL;
// colocando um valor onde ele mais a taxa de manutenção sejam maiores que o saldo (para realizar um saque, o valor escolhido tem que ser <= ao resultado dessa operação: $valorSaque + self::TAXA_MANUTENÇÃO, caso a soma desse valor ultrapasse nosso saldo atual, não é possivel sacar)
echo $contaBancariaService->sacar($contaCorrente, 13501) . PHP_EOL;
// saque maior que o limite padrão permitido de R$ 10000
echo $contaBancariaService->sacar($contaCorrente, 10001) . PHP_EOL;
// esvaziando e desativando conta para mais testes
echo $contaBancariaService->sacar($contaCorrente, 10000) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo $contaBancariaService->sacar($contaCorrente, 2700) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo $contaBancariaService->desativar($contaCorrente) . PHP_EOL;
// tentando saque com conta desativada
echo $contaBancariaService->sacar($contaCorrente, 10000) . PHP_EOL;
// reativando conta e depositando valores para prosseguir para outros testes em conta corrente
echo $contaBancariaService->ativar($contaCorrente) . PHP_EOL;
echo $contaBancariaService->depositar($contaCorrente, 14400) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo "\n";
/* 
* teste em conta poupança
*/
// tentando saque maior que o valor em conta
echo $contaBancariaService->sacar($contaPoupanca, 25000) . PHP_EOL;
// tentando saque com valor negativo
echo $contaBancariaService->sacar($contaPoupanca, -1) . PHP_EOL;
// esvaziando e desativando conta para tentar saque com conta desativada
echo $contaBancariaService->sacar($contaPoupanca, 24600) . PHP_EOL;
echo $contaBancariaService->saldo($contaPoupanca) . PHP_EOL;
echo $contaBancariaService->desativar($contaPoupanca) . PHP_EOL;
// tentando saque com conta poupança desativada e
echo $contaBancariaService->sacar($contaPoupanca, 1000) . PHP_EOL;
// testando minha mensagem personalizada mostrando que contas desativadas não possuem saldo já que, se está desativada o saldo precisou ser zero
echo $contaBancariaService->saldo($contaPoupanca) . PHP_EOL;
// reativando conta poupança e repondo valores para mais outros testes
echo $contaBancariaService->ativar($contaPoupanca) . PHP_EOL;
echo $contaBancariaService->depositar($contaPoupanca, 24600) . PHP_EOL;
echo $contaBancariaService->saldo($contaPoupanca) . PHP_EOL;
// tentando ativar uma conta já ativa
echo $contaBancariaService->ativar($contaPoupanca) . PHP_EOL;
echo "\n";

echo "==== TENTATIVA DE DESATIVAR COM SALDO DIFERENTE DE 0 ====" . PHP_EOL;
/*
* conta corrente 
* como estou aplicando um \n (quebra de linha aqui no terminal) entre uma linha de comando e outra (para separar conta corrente da conta poupança), não preciso aplicar um php_eol no final de cada linha de comando de tentativa incorreta de desativação de contas 
*/
echo $contaBancariaService->desativar($contaCorrente);
echo "\n";
/*
* conta poupança 
*/
echo $contaBancariaService->desativar($contaPoupanca);
echo "\n";

echo "==== DESATIVAÇÃO CORRETA DAS CONTAS ====" . PHP_EOL;
/*
* conta corrente
* esvaziando a conta corrente seguindo limite de saque padrão estabelecido em 10000, taxa de 400, conta ativa, valor maior que zero e (valor a ser sacado + constante de taxa de manutenção) sendo menores ou iguais ao saldo em conta
*/
echo $contaBancariaService->sacar($contaCorrente, 10000) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo $contaBancariaService->sacar($contaCorrente, 3600) . PHP_EOL;
echo $contaBancariaService->saldo($contaCorrente) . PHP_EOL;
echo $contaBancariaService->desativar($contaCorrente) . PHP_EOL;
echo "\n";
/*
* conta poupança
* esvaziando a conta poupança seguindo limite de saque (valor a ser sacado deve ser menor ou igual ao saldo em conta), valores positivos e conta ativa
*/
echo $contaBancariaService->sacar($contaPoupanca, 24600) . PHP_EOL;
echo $contaBancariaService->saldo($contaPoupanca) . PHP_EOL;
echo $contaBancariaService->desativar($contaPoupanca) . PHP_EOL;
echo "\n";

echo "==== TENTATIVA DE SAQUE COM CONTA DESATIVADA ====" . PHP_EOL;
/*
* conta corrente
*/
echo $contaBancariaService->sacar($contaCorrente, 4000) . PHP_EOL;
echo "\n";
/*
* conta poupança
*/
echo $contaBancariaService->sacar($contaPoupanca, 9088) . PHP_EOL;