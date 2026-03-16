<?php
require_once "funcoes.php";
$produtos = [
    [
        "nome" => "Camiseta canelada",
        "preco" => 79.90,
        "estoque" => 10
    ],
    [
        "nome" => "Calça jeans",
        "preco" => 129.90,
        "estoque" => 5
    ],
    [
        "nome" => "Tênis",
        "preco" => 299.90,
        "estoque" => 3
    ]
];

exibirProdutos($produtos);
echo podeSair();