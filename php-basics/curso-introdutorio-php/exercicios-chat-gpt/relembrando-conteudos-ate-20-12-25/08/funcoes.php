<?php 
// definindo o fuso horário para São Paulo, pois na hora de usar comandos como date() é importante ter o fuso horário correto, para me trazer o horário local e não de Tokyo por exemplo.
date_default_timezone_set("America/Sao_Paulo");

function exibirProdutos(array $produtos){
    foreach ($produtos as $produto) {
        echo "Produto: $produto[nome], Preço: R$ $produto[preco], Estoque: $produto[estoque] unidades" . PHP_EOL;
    }
}

function podeSair(){
    // se a hora for maior ou igual a 18, não pode sair
    $podeSair = date("H") >= 20 ? "Não pode sair, está tarde e é perigoso" : "Pode sair, aproveite!";
    return $podeSair;
}