<?php

spl_autoload_register(function (string $className) {
    $caminho = str_replace("MaisOrganizacao", "src", $className) . '.php';

    $caminhoCompleto = __DIR__ . DIRECTORY_SEPARATOR . $caminho;
    if (file_exists($caminhoCompleto)) {
        require_once $caminhoCompleto;
    }
});
