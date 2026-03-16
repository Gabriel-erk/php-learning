<?php 

spl_autoload_register(function(string $className){
    $caminhoArquivo = str_replace("InventarioCasaAbandonada", "src", $className) . ".php";
    $caminhoCompletoArquivo = __DIR__ . DIRECTORY_SEPARATOR . $caminhoArquivo;

    if (file_exists($caminhoCompletoArquivo)) {
        require_once $caminhoCompletoArquivo;
    }
});