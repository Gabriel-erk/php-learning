<?php

/* 
* função que recebe um array associativo com a chave produto que possui atributo preço
* aplica 10% em TODOS os produtos e retorna UM NOVO ARRAY com os valores atualizados de cada produto
*/

function aplica_desconto(array $produtos): array
{
    $produtos_com_desconto = [];
    $contador = 0;
    foreach ($produtos as $produto) {
        $produtos_com_desconto[$contador] = $produto['preco'] - ($produto['preco'] * 0.10);
        $contador++;
    }

    return $produtos_com_desconto;
}

$produtos = [
    "MrKing" => [
        "preco" => 20.00,
    ],
    "MrJoker" => [
        "preco" => 30.00,
    ],
    "MrBat" => [
        "preco" => 40.00,
    ],
    "MrQueen" => [
        "preco" => 50.00,
    ],
    "MrPoo" => [
        "preco" => 60.00,
    ],
];

$produtos_com_desconto = aplica_desconto($produtos);

echo "Valores Atualizados:" . PHP_EOL;
foreach ($produtos_com_desconto as $produto_com_desconto) {
    echo "$produto_com_desconto" . PHP_EOL;
};
