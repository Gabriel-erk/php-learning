<?php 

function exibirMensagem(string $mensagem) {
    echo "$mensagem";
}

// ao executar o código veremos que o resultado da funnção exibir mensagem vem primeiro do que o "olá" do meu echo
echo "olá " . exibirMensagem("gabriel") . PHP_EOL;
exibirMensagem("olá mundo!");

?>