<?php 

spl_autoload_register(function(string $className){
    // não quero que procure a partir da pasta raiz e sim de src
    //  feito isso, adiciono ao caminho desse símbolo (casse,interface,trait) que não esta no nosso arquivo a extensão ".php" para que eu consiga adiciona-lo corretamente no require (já que o require pede a extensão ".php" nos arquivos que ele vai incluir) 
    $caminho = str_replace("FaltaNotas", "src", $className) . ".php";
    $caminhoCompleto = __DIR__ . DIRECTORY_SEPARATOR . $caminho;

    if (file_exists($caminhoCompleto)) {
        require_once $caminhoCompleto;
    }
});