<?php 
$somaNotas = 0;
$somaNotas += $_POST['nota1'];
$somaNotas += $_POST['nota2'];
$somaNotas += $_POST['nota3'];
$notaFinal = $somaNotas / 3;

$serie = [
    'nomeSerie' => $_POST['nome'],
    'anoLancamentoSerie' => $_POST['ano'],
    'notaMedia' => $notaFinal,
    'generoSerie' => $_POST['genero']
];

// pegando o caminho absoluto do meu arquivo serie.json para que não ocorra erro no momento da execução do programa e ele consiga sempre encontrar o arquivo correto para eu conseguir executar o que eu quiser nele depois (no meu caso, como mostrado nas linhas abaixo, quero inserir conteúdo nele)
$caminhoAbsolutoArquivoSerieJson = __DIR__ . '/serie.json';
// transformando meu array associativo no formato de json para passa-lo para um arquivo json
$serieEmJson = json_encode($serie);
// inseridno conteudo no meu arquivo .json, indicando o caminho dele e depois o conteúdo a ser inserido
file_put_contents($caminhoAbsolutoArquivoSerieJson, $serieEmJson);

header("Location: sucesso.php?nomeSerie=$serie[nomeSerie]&anoLancamento=$serie[anoLancamentoSerie]&nota=$serie[notaMedia]&genero=$serie[generoSerie]");