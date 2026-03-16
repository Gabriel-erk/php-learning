<?php

function sacar(array $conta, float $valor_a_sacar) : array
{
    if ($conta['Saldo'] < $valor_a_sacar) {
        echo "Você não pode sacar, valor insuficiente." . PHP_EOL;
    } else {
        $conta['Saldo'] -= $valor_a_sacar;
    }
    return $conta;
}

// especificando que o valor do primeiro parâmetro é array
// especificando que o valor do parâmetro que vai guardar o depósito tem que ser do tipo float, fazendo com que o erro seja mostrado nessa linha no terminal ao tentar passar outro argumento - valores inteiros são aceitos aqui também (mais explicações na tabela de conversões na doc do php) porém o contrário não funcionaria
// após os : específico o tipo do retorno da minha função
function depositar(array $conta, float $valor_a_depositar) : array
{
    if ($valor_a_depositar > 0) {
        $conta['Saldo'] += $valor_a_depositar;
    } else {
        echo "Digite um valor válido para saque." . PHP_EOL;
    }

    /* retornando a conta ao invés do valor (nesse caso retornando todas as chaves, saldo, titular....) - caso não retorne nada, o a linha: $contasCorrentes['123.241.453.83'] = depositar($contasCorrentes['123.241.453.83'], -70); retornará nulo, pois a chave com esse cpf recebera um valor nulo, já que nada foi retornado para ela */
    return $conta;
}