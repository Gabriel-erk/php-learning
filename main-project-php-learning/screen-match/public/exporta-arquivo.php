<?php 

$filme = [
    'nome' => $_POST['nome'],
    'ano' => $_POST['ano'],
    'nota' => $_POST['nota'],
    'genero' => $_POST['genero']
];

$caminhoAbsolutoJsonFilme = __DIR__ . '/filme.json';
// file_put_contents é para eu adicionar conteudo a um arquivo, no caso, quero adicionar no 'filme.json', como mostrado na váriavel acima, como ele não existe, será criado quando o file_put for executado, como segundo parâmetro, informo o CONTEÚDO que quero inserir no meu arquivo filme.json, que no caso, é o meu array associativo $filme no formato de json (função json_encode converte o valor passado para ele para o formato de json)
file_put_contents($caminhoAbsolutoJsonFilme, json_encode($filme));

// cabeçalho http que redireciona o usuário (feito por conta do processo POST/redirect/GET) - este faz parte da parte do redirect, onde para redirecionar o usuário, é preciso de um cabeçalho http
// Location: sucesso.php indica que quero enviar para a página de sucesso.php (não funcionou com o caminho absoluto)
// porém o "?" colocado após "suecesso.php" (e quando colocado em uma URL) quer dizer que, o que vier depois dele (ponto de interrogação "?") é um parâmetro a ser passado
// aqui estou dizendo que o parâmetro filme (descrito como "filme=" na url) é o valor do meu array associativo $filme['nome']
// já que descrevi que o nome do filme será passado na url com o parâmetro "filme", ai entra a ultima parte do processo "POST/redirect/GET", que é onde vou pegar as informações através da superglobal $_GET e acessarei o campo "filme"
header('Location: sucesso.php?filme=' . $filme['nome']);
