<?php 

$contasBancarias = [
    [
        "titular" => "João",
        "saldo" => 10000.0
    ],
    [
        "titular" => "Maria",
        "saldo" => 3000.0
    ],
    [
        "titular" => "José",
        "saldo" => 500.0
    ]
];

// devido ao foreach, não precisamos mais do índice para acessar os elementos do array, pois o próprio foreach já faz isso para nós, então podemos acessar diretamente os valores dos elementos do array associativo utilizando a sintaxe $contaBancaria["chave/valor/no caso queremos o titular ou o saldo"]
foreach ($contasBancarias as $contaBancaria) {
    echo "Titular: " . $contaBancaria["titular"] . " - Saldo: " . $contaBancaria["saldo"] . PHP_EOL;
}