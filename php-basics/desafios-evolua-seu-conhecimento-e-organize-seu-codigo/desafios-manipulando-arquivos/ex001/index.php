<?php
$caminhoArquivoSerie = __DIR__ . "/texto.txt";

// a prática de abrir e fechar o arquivo permite que os dados sejam salvos com sucesso, prática feita apenas quando  não se usa um dos comandos utilizados antes como: file_get, file_put, etc
$texto = fopen($caminhoArquivoSerie, "a");
fwrite($texto, "o php é incrivel");
fclose($texto);
