<?php


// array associativo, adicionando outros várias chaves para um único array (no caso por conta do contexto, quero que cada array tenha informações diferentes a respeito de uma conta bancária, para isso, posso fazer uso de arrays associativos, onde crio a chave-valor para eles, como um mapa/objeto só que mais simplificado)


$contasCorrentes = [
    123445123 => [
        'Titular' => 'Hylander Comédia',
        'Saldo' => 87631
    ],
    
    1234334513 => [
        'Titular' => 'Marco Dos Anjos',
        'Saldo' => -98765
    ],
    
    1232414533 => [
        'Titular' => 'Fulano de tal',
        'Saldo' => 389778
    ]
];

// adicionando um valor no array associativo $contasCorrentes com o indice que escolhi (1342144532) e os valores que escolhi (foi adicionado na última posição do array)
$contasCorrentes[1342144532] = [
    'Titular' => 'Jorgin',
    'Saldo' => 1231421
];

// adicionando um item no array sem declarar a chave que ele vai (vai ser jogado na última posição do array, e como todos os valores são númericos, ele pegara o valor númerico antes dele e incrementará 1)
// caso $contasCorrentes tivesse as chaves como strings, ele pegaria o primeiro inteiro número dísponivel, no caso, onde todas as chaves anteriores são strings, seria o valor 0
$contasCorrentes[] = [
    'Titular' => 'Marcelo',
    'Saldo' => 878787
];

// definindo o nome do indice de cada array associativo dentro do array contasCorrentes como cpf e o nome do atributo que conterá os valores de cada indice (terá os valores titular e saldo como "$conta")
foreach ($contasCorrentes as $cpf => $conta) {
    echo "Indíce = $cpf ";
    echo "Nome = " . $conta['Titular'] . PHP_EOL;
}