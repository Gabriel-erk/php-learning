<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "autoload.php";

use MaisOrganizacao\Model\{
    ClienteTb,
    ContaCorrenteTb,
    ContaPoupancaTb,
    ContaSalarioTb,
    TipoContaTb
};
// como é apenas um que vou trazer do service, não há necessidade de usar as {}
use MaisOrganizacao\Service\ContaBancariaServiceTb;

$contaBancariaServiceTb = new ContaBancariaServiceTb();

// criando 3 cliente
$clienteUm = new ClienteTb("Gabriel Erick", "984.123.834-97");
$clienteDois = new ClienteTb("Pierre Orno", "123.984.756-98");
$clienteTres = new ClienteTb("Mike Swentchzel", "563.423.245-56");

// criando uma conta de cada tipo e colocando todas em um array (não sei colocar em um array do tipo "ContaBancariaTb" então deixei sem tipagem mesmo)
$contas = [
    $contaCorrente = new ContaCorrenteTb($clienteUm, 30000),
    $contaPoupanca = new ContaPoupancaTb($clienteDois, 20000),
    $contaSalario = new ContaSalarioTb($clienteTres, 25000)
];

// var_dump($contas);

// percorrendo com foreach e chamando sacar(500) em todas
foreach ($contas as $conta) {
    echo $contaBancariaServiceTb->sacar($conta, 500) . PHP_EOL;
    echo $contaBancariaServiceTb->verSaldo($conta) . PHP_EOL;
}

echo "\n";

echo "--- TESTES DEPÓSITO ---" . PHP_EOL;
// depósito funciona em conta corrente, poupança e salário, pois quando é conta salário faço uso do polimorfismo para sobrescrever o método depositar, obrigado a usar outro (depositarSalario, como voce havia pedido), não sei se foi a abordagem correta, mas tentei
foreach ($contas as $conta) {
    echo $contaBancariaServiceTb->depositar($conta, 500) . PHP_EOL;
    echo $contaBancariaServiceTb->verSaldo($conta) . PHP_EOL;
    echo "\n";
}

echo "--- TESTES SAQUE ---" . PHP_EOL;
// testando regras em comum de cada conta

// 1 - sacar valor igual a zero
foreach ($contas as $conta) {
    echo $contaBancariaServiceTb->sacar($conta, 0) . PHP_EOL;
    echo $contaBancariaServiceTb->saldo($conta) . PHP_EOL;
}

echo "\n";

// 2 - valor maior que o saldo em conta
foreach ($contas as $conta) {
    // armazenando um valor maior que o saldo para tentar saca-lo em cada conta
    $valorMaiorQueSaldo = $contaBancariaServiceTb->saldo($conta) + 1;
    echo $contaBancariaServiceTb->sacar($conta, $valorMaiorQueSaldo) . PHP_EOL;
    echo $contaBancariaServiceTb->saldo($conta) . PHP_EOL;
}

echo "\n";

// 3 - saque com conta inativa (sim, vai ter msg pra cacete)
// saque respeita regras de saque de cada conta
// desativar conta impede operações
// interface esta sendo respeitada pois todas as contas possuem o método depositar e sacar
foreach ($contas as $conta) {
    if ($conta->tipoConta == TipoContaTb::Corrente) {
        // coloquei como maior que um pois tava indo pra uns tipos de 0 muito loucos
        // antes estava >= 0 - porém, se for igual a zero, por que continuar o loop? erro de lógica isso
        while ($contaBancariaServiceTb->saldo($conta) > 0) {
            if ($contaBancariaServiceTb->saldo($conta) > 10000) {
                // obs: caso sacar retornar false, virará um loop ifinito, ideal seria parar o loop em caso isso acontecer para tratar da melhor forma
                echo $contaBancariaServiceTb->sacar($conta, 10000) . PHP_EOL;
                echo number_format($contaBancariaServiceTb->saldo($conta), 2, ',', '.') . PHP_EOL;
            } else {
                // quando o programa chegar até aqui, signicifa que o saldo já é menor que 10000 e posso remove-lo por completo apenas com um único saque, logo, o que preciso fazer é: pegar o saldo restante, pois é a base do cálculo que irei realizar para remover tudo, depois eu me faço a pergunta, que numero que, quando eu aumentar 500, vai dar exatamente o saldo que quero tirar? (ou seja, para tirar o valor inteiro da conta?), nesse caso, eu divido o meu saldo atual por 105% (1.05), descobrindo o valor ANTES do aumento de 5% de quando eu acionar meu método sacar, assim, quando eu chamar este método, aumentará 5% do valor que estou pedindo para sacar, atingindo o total que a conta possui, tirando tudo de uma única vez (mais um erro de lógica)
                $saldoAtualContaCorrente = $contaBancariaServiceTb->saldo($conta); // pegando o valor total da conta, o valor que quero remover de fato
                $valor = $saldoAtualContaCorrente / 1.05;
                echo $contaBancariaServiceTb->sacar($conta, $valor) . PHP_EOL;
                echo $contaBancariaServiceTb->verSaldo($conta) . PHP_EOL;
            }
        }
    } else {
        $saldoAtual = $contaBancariaServiceTb->saldo($conta);
        echo $contaBancariaServiceTb->sacar($conta, $saldoAtual) . PHP_EOL;
        echo $contaBancariaServiceTb->verSaldo($conta) . PHP_EOL;
    }
    echo $contaBancariaServiceTb->desativar($conta) . PHP_EOL;
    echo $contaBancariaServiceTb->sacar($conta, 10) . PHP_EOL;
    echo $contaBancariaServiceTb->depositar($conta, 20) . PHP_EOL;
    echo "\n";
}

// trait está sendo reutilizada nas classes de contas bancárias