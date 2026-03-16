<?php 

require_once 'produto.php';

function exibirProduto(array $produto){
    echo "Nome: {$produto['nome']}" . PHP_EOL;
    echo "Preço: {$produto['preco']}" . PHP_EOL;
    echo "Estoque: {$produto['estoque']}" . PHP_EOL;
}

// variavel vem do arquivo produto.php
exibirProduto($produto);


?>