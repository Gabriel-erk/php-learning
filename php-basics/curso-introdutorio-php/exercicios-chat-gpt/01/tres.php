<?php

// criar uma array associativo que represente os produtos, contendo os campos nome e preço, depois lista-los com foreach formatando assim "Produto: Nome - Preço: R$XX,XX"

$produtos = [
    "Produto01" => [
        "Nome" => "X-burgão",
        "Preço" => 10.90
    ],
    "Produto02" => [
        "Nome" => "X-meczão",
        "Preço" => 13.90
    ],
    "Produto03" => [
        "Nome" => "X-saladão",
        "Preço" => 9.90
    ],
    "Produto04" => [
        "Nome" => "X-piclão",
        "Preço" => 11.90
    ],
    "Produto05" => [
        "Nome" => "X-tomatão",
        "Preço" => 7.80
    ],
];

foreach ($produtos as $produto) {
    echo "Produto: {$produto['Nome']} - Preço: R$" . number_format($produto['Preço'], 2, ',', '.') . PHP_EOL;
}