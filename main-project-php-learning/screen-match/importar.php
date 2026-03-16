<?php 

// pegando o caminho do arquivo para que, na hora de acessar/usa-lo eu sempre vá EXATAMENTE onde ele está, para que sempre acerte o caminho dele, como abaixo (na função file_get_contents), caso eu apenas ussasse o caminho padrão, futuramente eu poderia ter algum erro no momento de encontrar o arquivo
// __DIR__ diz: "procure filmes.json na pasta atual"
$caminhoArquivoFilmes = __DIR__ . '/filmes.json';

// está função lê tudo do arquivo filmes.json e me retorna uma string, onde eu só preciso converte-lo para array associativo agora
$conteudoArquivoFilme = file_get_contents($caminhoArquivoFilmes);
var_dump($conteudoArquivoFilme);

$filmes = json_decode($conteudoArquivoFilme, true);

// para tirar a dúvida se estou realmente lendo o arquivo, posso altera-lo manualmente e depois executar aqui novamente
var_dump($filmes);