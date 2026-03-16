<!-- consigo utilizar código php aqui dentro da abertura e fechamento php por conta do arquivo ter a extensão ".php"  -->
<!-- tudo dentro das tags de abertura e fechamento de comandos php será EXECUTADO e tudo fora, será exibido como html -->
<!-- dentro das tags de abertura e fechamento de comandos php abaixo estou exibindo o valor da superglobal $_GET no campo "filme", que só existe devido a sua definição e atribuição de valor no arquivo "exporta-arquivo.php", que faz, nada mais e nada menos que, no final do arquivo redirecionar o usuário para esta página aqui passando o nome do filme como parâmetro na sua URL -->
<!-- preciso do "echo" pois não tem como eu exibir na tela algo apenas com $_GET['filme'], mesmo estando dentro de uma tag html que faça isso, que exiba conteúdo, ainda é necessário o echo para exibir informações php dentro de tags htmlç -->
<h1>Sucesso! Filme <?php echo $_GET['filme'] ?> inserido.</h1>

<?php
// trazendo o caminho correto do meu arquivo filme.json
$caminhoAbsolutoArquivoFilmeJson = __DIR__ . '/filme.json';
// pegando as informações presentes no arquivo filme.json
$informacoesFilme = file_get_contents($caminhoAbsolutoArquivoFilmeJson);
// convertendo as informações em json da váriavel ($informacoesFilme) para uma array associativo (vem por padrão como um objeto, mas o valor booleano "true" passado como segundo parâmetro me devolve um array associativo)
$informacoesFilmeEmArray = json_decode($informacoesFilme, true);
var_dump($informacoesFilmeEmArray);
?>

<ul>
    <li>Nome do filme: <?php echo $informacoesFilmeEmArray['nome']?></li>
    <li>Ano de lançamento: <?php echo $informacoesFilmeEmArray['ano']?></li>
    <li>Nota média: <?php echo $informacoesFilmeEmArray['nota']?></li>
    <li>Genêro do filme: <?php echo $informacoesFilmeEmArray['genero']?></li>
</ul>