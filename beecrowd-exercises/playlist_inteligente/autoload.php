<?php

spl_autoload_register(function (string $className) {
    // o search é sempre o nome do namespace de onde aquele símbolo está, em "src" substituo o nome do namespace para a pasta onde todos os simbolos estão, no caso, src, ficando src/Model/Musica...etc
    $caminho = str_replace("PlaylistInteligente", "src", $className) . '.php';

    $caminhoCompleto = __DIR__ . DIRECTORY_SEPARATOR . $caminho;
    // para ver o valor do caminho quando for executado e ter certeza que não esta dando erro
    // var_dump($caminhoCompleto);
    if (file_exists($caminhoCompleto)) {
        require_once $caminhoCompleto;
    }
});
