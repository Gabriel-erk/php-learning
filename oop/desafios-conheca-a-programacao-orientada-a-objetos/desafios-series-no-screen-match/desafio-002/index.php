<?php 

require_once __DIR__ . '/ClienteDesafioChat.php';
require_once __DIR__ . '/ContaBancariaDesafioChat.php';
require_once __DIR__ . '/ContaBancariaServiceDesafioChat.php';
require_once __DIR__ . '/ContaCorrenteDesafioChat.php';
require_once __DIR__ . '/ContaPoupancaDesafioChat.php';

$contaBancariaService = new ContaBancariaServiceDesafioChat();

$clienteUm = new ClienteDesafioChat("Gabriel Não Sabe Amar Pouco", "499.823.123-23");
$contaCorrenteClienteUm = new ContaCorrenteDesafioChat($clienteUm, 23000);
echo "------------ TESTES CONTA CORRENTE ------------" . PHP_EOL;
// echo var_dump($contaCorrenteClienteUm);
echo $contaBancariaService->estaAtiva($contaCorrenteClienteUm) . PHP_EOL;
echo "Saldo inicial: " . $contaCorrenteClienteUm->getSaldo() . PHP_EOL;
echo $contaBancariaService->depositar($contaCorrenteClienteUm, 2000) . PHP_EOL;
echo "Novo saldo: " . $contaCorrenteClienteUm->getSaldo() . PHP_EOL;
// saque foi efetuado descontando a taxa baseado na regra que estipulei
echo $contaBancariaService->sacar($contaCorrenteClienteUm, 3000) . PHP_EOL;
echo "Novo saldo: " . $contaCorrenteClienteUm->getSaldo() . PHP_EOL;

// echo var_dump($contaCorrenteClienteUm);
// se realizar o saque abaixo não vai dar pois é maior que o limite estipulado de 10k
// echo $contaBancariaService->sacar($contaCorrenteClienteUm, 22000) . PHP_EOL;
// segundo saque efetuado e descontando a taxa com base na regra que estipulei
echo $contaBancariaService->sacar($contaCorrenteClienteUm, 10000) . PHP_EOL;
echo "Novo saldo: " . $contaCorrenteClienteUm->getSaldo() . PHP_EOL;
echo $contaBancariaService->sacar($contaCorrenteClienteUm, 10000) . PHP_EOL;
echo "Novo saldo: " . $contaCorrenteClienteUm->getSaldo() . PHP_EOL;
// removendo o restinho que sobrou dos descontos com a taxa
echo $contaBancariaService->sacar($contaCorrenteClienteUm, 800) . PHP_EOL;
echo "Novo saldo: " . $contaCorrenteClienteUm->getSaldo() . PHP_EOL;
echo $contaBancariaService->desativarConta($contaCorrenteClienteUm) . PHP_EOL;
echo $contaBancariaService->estaAtiva($contaCorrenteClienteUm) . PHP_EOL;
// saque para não funcionar
echo $contaBancariaService->sacar($contaCorrenteClienteUm, 2000) . PHP_EOL;

echo "------------ TESTES CONTA POUPANÇA ------------" . PHP_EOL;

$clienteDois = new ClienteDesafioChat("Gabriel Ama Demais no Sec da Putaria", "987.123.823-98");
$contaPoupancaClienteDois = new ContaPoupancaDesafioChat($clienteDois, 12000);

echo $contaBancariaService->estaAtiva($contaPoupancaClienteDois) . PHP_EOL; 
echo $contaBancariaService->depositar($contaPoupancaClienteDois, 4000) . PHP_EOL;
echo "Novo saldo: " . $contaPoupancaClienteDois->getSaldo() . PHP_EOL;
echo $contaBancariaService->sacar($contaPoupancaClienteDois, 2000) . PHP_EOL;
echo "Novo saldo: " . $contaPoupancaClienteDois->getSaldo() . PHP_EOL;
// devido ao fato de só implemetnar a regra que "pode sacar contanto que seja maior ou igual zero" isso aqui é possivel (no caso, sacar mais do que se tem disponivel)
echo $contaBancariaService->sacar($contaPoupancaClienteDois, 15000) . PHP_EOL;
echo "Novo saldo: " . $contaPoupancaClienteDois->getSaldo() . PHP_EOL;
// repondo a cagada acima para mais testes
echo $contaBancariaService->depositar($contaPoupancaClienteDois, 7000) . PHP_EOL;
echo "Novo saldo: " . $contaPoupancaClienteDois->getSaldo() . PHP_EOL;
// não funciona pois o saque da conta poupança tem que ser maior que zero
echo $contaBancariaService->sacar($contaPoupancaClienteDois, -50) . PHP_EOL;
echo "Novo saldo: " . $contaPoupancaClienteDois->getSaldo() . PHP_EOL;
// sacando tudo para poder desativar a conta
echo $contaBancariaService->sacar($contaPoupancaClienteDois, 6000) . PHP_EOL;
echo "Novo saldo: " . $contaPoupancaClienteDois->getSaldo() . PHP_EOL;
// desativando conta para testar se funciona saque etc 
echo $contaBancariaService->desativarConta($contaPoupancaClienteDois) . PHP_EOL;
// funciona pois este método não verifica se a conta esta ativa ou não, ele apenas permite o saque contanto que seja maior que zero (independente da conta estar ativa)
echo $contaBancariaService->sacar($contaPoupancaClienteDois, 6000) . PHP_EOL;
echo "Novo saldo: " . $contaPoupancaClienteDois->getSaldo() . PHP_EOL;
// deposito isso não se aplica pois o método "depositar" de conta poupança é o mesmo de "conta bancaria" pois ele não foi reescrito igual "sacar" foi em "conta poupança"
echo $contaBancariaService->depositar($contaPoupancaClienteDois, 6000) . PHP_EOL;
echo "Novo saldo: " . $contaPoupancaClienteDois->getSaldo() . PHP_EOL;
// mostrando que a conta não está ativa
echo var_dump($contaPoupancaClienteDois);