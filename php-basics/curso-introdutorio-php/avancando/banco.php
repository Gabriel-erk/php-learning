<?php

/*
* require once vai trazer outro arquivo para este aqui (no caso, funcoes.php), por debaixo dos panos é como se o conteúdo do arquivo funcoes.php estivesse sido colado aqui 
* require diz que ele é essencial para o programa, então, caso não o encontre, retorna um fatal error e impede a execução do restante do programa

* once diz que, ele vai verificar se o arquivo já foi importado para cá, então caso tenha o seguinte:  linha 1 - require_once 'funcoes.php'; e na linha 2 - require_once 'funcoes.php'; por conta do once ele irá verificar que o arquivo JÁ foi incluido, e seguirá normalmente, sem interromper a execução, dar um aviso ou erro
*/
// require_once 'funcoes.php';

/*
* outra forma de trazer um arquivo 
! require 'funcoes.php';
* porém desta forma, caso aconteça de: linha 1 - require 'funcoes.php'; e na linha 2 - require 'funcoes.php'; - será como se estivesse colando o conteúdo do código funcoes.php 2 vezes, tentando sobrescrever a função, o que não dará certo, e retornará um fatal erro
*/ 

/*
* outra forma de trazer um arquivo 
! include 'funcoes.php';
* desta forma diz que o arquivo funcoes.php não é essencial, e não será necessário parar a execução do programa caso ele não seja encontrado, então, ele retornará apenas um warning e continuará a execução (onde obviamente não fará o esperado)
* porém desta forma, caso aconteça de: linha 1 - include 'funcoes.php'; e na linha 2 - require 'funcoes.php'; - será como se estivesse colando o conteúdo do código funcoes.php 2 vezes, tentando sobrescrever a função, o que não dará certo, e retornará um fatal erro
*/ 

$contasCorrentes = [
    '123.445.123-98' => [
        'Titular' => 'Hylander Comédia',
        'Saldo' => 100
    ],

    '123.433.451-93' => [
        'Titular' => 'Marco Dos Anjos',
        'Saldo' => 300
    ],

    '123.241.453.83' => [
        'Titular' => 'Fulano de tal',
        'Saldo' => 500
    ]
];

// dizendo que a chave '123.241.453.83' vai receber o retorno da função sacar, ela que recebe a conta '123.241.453.83' como parâmetro e o valor 500 para sacar - onde a função irá
$contasCorrentes['123.241.453.83'] = sacar($contasCorrentes['123.241.453.83'], 500);

// retornando pra minha conta outra conta onde o depósito foi realizado com sucesso
$contasCorrentes['123.241.453.83'] = depositar($contasCorrentes['123.241.453.83'], 20);

foreach ($contasCorrentes as $cpf => $conta) {
    /* 
    * intituladas de string complexas, não por serem complexas, mas por nos permitirem utilizar dados complexos em strings, sem precisar ficar concatenando (vulgo interpolação), podemos chamar um array associativo em uma string, com essa interpolação, onde apenas envolveremos o "dado complexo" entre chaves
    * outra forma de fazer isso, seria assim "$cpf $conta[titular] $conta [Saldo]" que também daria certo, onde você remove os aspas das chaves 'titular' e 'saldo', é uma forma também, maas, eu prefiro usar da forma com {} mesmo pois permite maior organização e padronização do código, pelo menos pra mim ficaria mais legível
    */
    echo "$cpf {$conta['Titular']} {$conta['Saldo']}" . PHP_EOL;
}