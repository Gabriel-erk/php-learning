<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoload.php';

use FaltaNotas\Model\{ClienteTc, ContaCorrenteTc, ContaPoupancaTc};
use FaltaNotas\Services\BancoServiceTc;
use FaltaNotas\Enums\TipoContaTc;

// criar 2 clientes
$clienteUm = new ClienteTc("Gabriel Erick", "999.444.333-98");
$clienteDois = new ClienteTc("Cristiano", "983.415.123-09");

$service = new BancoServiceTc();

// criar conta corrente e poupança
$contaCorrente = new ContaCorrenteTc($clienteUm, 35000);
echo $service->criarConta($contaCorrente);
$contaPoupanca = new ContaPoupancaTc($clienteDois, 25000);
echo $service->criarConta($contaPoupanca);

echo "\n";

echo "=== Total dinheiro do banco ===\n";
echo $service->totalDinheiroBanco();

echo "\n";

/* 
* depósitos
*/
echo "=== Depósitos simples === \n";
echo $service->depositar($contaCorrente, 5000);
echo $service->depositar($contaPoupanca, 1000);

echo "\n";

echo "=== Saques simples === \n";
echo $service->sacar($contaCorrente, 5000);
echo $service->sacar($contaPoupanca, 1000);

echo "\n";
echo "=== Depósitos com valores negativos === \n";
// valor negativo
echo $service->depositar($contaCorrente, -5);
echo $service->depositar($contaPoupanca, -10);

echo "\n";
echo "=== Saques Incorretos (conta corrente) === \n";
// valor negativo
echo $service->sacar($contaCorrente, -1);
// valor que não está em conta
echo $service->sacar($contaCorrente, 1000000);

echo "\n";

echo "=== Saques Incorretos (conta poupança) === \n";
echo $service->sacar($contaPoupanca, -1);
echo $service->sacar($contaPoupanca, 1000000);

echo "\n";
echo "=== Transferências simples === \n";
// corrente - poupanca
echo $service->transferir($contaCorrente, $contaPoupanca, 1000);
// poupanca - corrente 
echo $service->transferir($contaPoupanca, $contaCorrente, 3000);

echo "\n";
echo "=== Transferências inválidas === \n";
// valor negativo
echo $service->transferir($contaCorrente, $contaPoupanca, -1);
// valor maior que o saldo
echo $service->transferir($contaCorrente, $contaPoupanca, 1000000);

echo "\n";
echo "=== Esvaziamento de conta e desativação === \n";

$contas = $service->getContas();

foreach ($contas as $conta) {
    // o valor aqui vai depender da conta passada (poupança ou corrente)
    $valorAsacar = $conta->getSaldo();
    if (
        $conta->getSaldo() > 0 &&
        $conta->getTipo() == TipoContaTc::CORRENTE
    ) {
        // echo $service->getSaldo($conta);
        // qual o valor que, quando acrescentado a taxa (de 5%) terei o valor total em conta? r: este valor é 5% a menos do saldo atual, reduzindo 5% dele agora, quando disparar o método, aumentará 5% e assim consigo retirar todo o SALDO, por mais que eu possa chamar saque devido ao limite extra, no caso atual eu não chamarei
        $valorAsacarContaCorrente = $valorAsacar / 1.05;
        echo $service->sacar($conta, $valorAsacarContaCorrente);
        echo "\n";
        echo "=== Teste saque por limite extra === \n";
        echo $service->sacar($conta, 1000);
    } else {
        echo $service->sacar($conta, $valorAsacar);
    }
    // quero que essas duas linhas sejam executadas independentemente da conta em questão, este loop percorre um array com 2 posíções (conta corrente e poupança, logo, na primeira vai imprimir as info da corrente e logo após da poupança, ou vice versa, assim não ficando muito poluido os logs)
    echo $service->getSaldo($conta);
    echo $service->desativar($conta);
    echo "\n";
}

echo "=== Saque e depósito em conta inativa === \n";
foreach ($contas as $conta) {
    echo $service->sacar($conta, 1000);
    echo $service->depositar($conta, 1000);
    echo $service->getSaldo($conta);;
}
echo "\n";

// criando conta teste para ver questão de id e etc
$clienteTeste = new ClienteTc("Teste", "987.134.123-87");
$contaTeste = new ContaPoupancaTc($clienteTeste, 10000);
echo $service->criarConta($contaTeste);
// listando contas
$service->listarContas();

echo "\n";

echo "=== Total dinheiro do banco ===\n";
echo $service->totalDinheiroBanco();