contas-corrente

<?php

// array associativo, adicionando outros várias chaves para um único array (no caso por conta do contexto, quero que cada array tenha informações diferentes a respeito de uma conta bancária, para isso, posso fazer uso de arrays associativos, onde crio a chave-valor para eles, como um mapa/objeto só que mais simplificado)
$conta1 = [
    'Titular' => 'Hylander Comédia',
    'Saldo' => 87631
];

$conta2 = [
    'Titular' => 'Marco Dos Anjos',
    'Saldo' => -98765
];

$conta3 = [
    'Titular' => 'Fulano de tal',
    'Saldo' => 389778
];

$contasCorrentes = [$conta1, $conta2, $conta3];

foreach ($contasCorrentes as  $contaCorrente) {
    echo $contaCorrente['Saldo'];
}