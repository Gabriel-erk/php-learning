<?php
require_once 'Contracts/Tributavel.php';
require_once 'Traits/Registravel.php';
require_once 'Conta/Conta.php';
require_once 'Conta/ContaCorrente.php';
require_once 'Conta/ContaPoupanca.php';
require_once 'Exceptions/SaldoInsuficienteException.php';
require_once 'Exceptions/ValorInvalidoException.php';

use Practice\Conta\{ContaCorrente, ContaPoupanca};
use Practice\Enums\TipoConta;
use Practice\Exceptions\{SaldoInsuficienteException, ValorInvalidoException};

$contas = [];

function encontrarConta(array $contas)
{
    echo "Informe o número da conta:" . PHP_EOL;
    $numeroConta = (int) fgets(STDIN);

    foreach ($contas as $conta) {
        if ($conta->numero == $numeroConta) {
            return $conta;
        }
    }
}

while (true) {
    echo "===== BANCO =====" . PHP_EOL;

    echo "1 - Criar conta" . PHP_EOL;
    echo "2 - Depositar" . PHP_EOL;
    echo "3 - Sacar" . PHP_EOL;
    echo "4 - Consultar saldo" . PHP_EOL;
    echo "5 - Aplicar rendimento (conta poupança)" . PHP_EOL;
    echo "6 - Ver histórico" . PHP_EOL;
    echo "7 - Calcular taxas (conta corrente)" . PHP_EOL;
    echo "0 - Sair" . PHP_EOL;

    echo "Sua opção: ";
    $opcao = (int) fgets(STDIN);


    if ($opcao == 1) {
        echo "Informe o número da conta: " . PHP_EOL;
        $numeroConta = (int) fgets(STDIN);
        echo "Informe o seu nome: " . PHP_EOL;
        $nomeConta = fgets(STDIN);
        echo "Informe o saldo inicial da conta: " . PHP_EOL;
        $saldoConta = (int) fgets(STDIN);

        echo "===== TIPO DA CONTA =====" . PHP_EOL;
        echo "Conta Corrente (1)" . PHP_EOL;
        echo "Conta Poupança (2)" . PHP_EOL;

        echo "Sua opção: ";
        $tipoConta = (int) fgets(STDIN);

        if ($tipoConta == 1) {
            $contas[] = new ContaCorrente($numeroConta, $nomeConta, $saldoConta);
            echo "Conta corrente criada com sucesso!" . PHP_EOL;
        } elseif ($tipoConta == 2) {
            $contas[] = new ContaPoupanca($numeroConta, $nomeConta, $saldoConta);
            echo "Conta poupança criada com sucesso!" . PHP_EOL;
        } else {
            echo "Tipo de conta inválido." . PHP_EOL;
        }
    } elseif ($opcao == 2) {
        $conta = encontrarConta($contas);

        echo "Informe o valor do depósito:" . PHP_EOL;
        $valor = (float) fgets(STDIN);
        try {
            $conta->depositar($valor);
            echo "Depósito de: $valor realizado com sucesso!" . PHP_EOL;
        } catch (ValorInvalidoException $th) {
            echo "Tentativa de depósito de: $valor fracassou." . PHP_EOL;
            echo "Razão: " . $th->getMessage() . PHP_EOL;
        }
    } elseif ($opcao == 3) {
        $conta = encontrarConta($contas);

        echo "Informe o valor do saque:" . PHP_EOL;
        $valor = (float) fgets(STDIN);

        try {
            $conta->sacar($valor);
            echo "Saque de: $valor realizado com sucesso!" . PHP_EOL;
        } catch (SaldoInsuficienteException | ValorInvalidoException $th) {
            echo "Tentativa de saque de: $valor fracassou." . PHP_EOL;
            echo "Razão: " . $th->getMessage() . PHP_EOL;
        }
    } elseif ($opcao == 4) {
        $conta = encontrarConta($contas);

        echo "Valor disponível: " . $conta->consultarSaldo() . PHP_EOL;
    } elseif ($opcao == 5) {
        $conta = encontrarConta($contas);

        if ($conta->tipoConta == TipoConta::POUPANCA) {
            if ($conta->consultarSaldo() > 0) {
                $conta->aplicarRendimento();
                echo "Rendimento aplicado com sucesso!" . PHP_EOL;
            } else {
                echo "Saldo insuficiente para aplicar rendimento." . PHP_EOL;
            }
        } else {
            echo "Apenas contas poupança podem realizar este processo." . PHP_EOL;
        }
    } elseif ($opcao == 6) {
        $conta = encontrarConta($contas);

        echo "=== HISTÓRICO DE OPERAÇÕES ($conta->tipoConta->name) ===" . PHP_EOL;
        foreach ($conta->historico() as $operacao) {
            echo $operacao . PHP_EOL;
        }
    } elseif ($opcao == 7) {
        $conta = encontrarConta($contas);

        if ($conta->tipoConta == TipoConta::CORRENTE) {
            echo "O valor da taxa com base em seu saldo é: " . $conta->calculcarTaxa() . PHP_EOL;
        } else {
            echo "Apenas contas correntes podem realizar este processo." . PHP_EOL;
        }
    } elseif ($opcao == 0) {
        echo "Obrigado por utiliza o sistema!" . PHP_EOL;
        break;
    } else {
        echo "Opção inválida, tente novamente.";
    }
}
