<?php
// requisitando a classe Filme.php (definida como uma classe de modelo/estrutura/esqueleto para meus filmes, pois depois de criar um objeto a partir dela, eles tomam a sua "própria forma", com seus próprios valores)
require_once __DIR__ . '/src/Model/Filme.php';
require_once __DIR__ . '/src/Model/Serie.php';
//  mesmo executando este arquivo fora da pasta que ele está, o require_once irá encontrar o arquivo funcoes.php corretamente, graças ao uso do caminho relativo e devido ao fato que o require_once sempre busca primeiro na pasta do arquivo que está sendo executado
/*
* caminho absoluto exemplo: /var/www/html/php-criando-sua-aplicacao/screen-match/funcoes.php, é onde o arquivo se localiza em nossa maquina, assim, manipulando para que o php sempre busque esse arquivo nesse local específico, independente de onde o arquivo que está fazendo o require_once esteja
* caminho relativo exemplo: __DIR__ . '/funcoes.php', onde __DIR__ é uma constante mágica do PHP que representa o diretório atual do arquivo que está sendo executado, ou seja, ele sempre aponta para a pasta onde o arquivo screen-match.php está localizado, assim, mesmo que eu execute o arquivo screen-match.php de outro local, o require_once irá buscar o arquivo funcoes.php na pasta correta, que é a mesma pasta onde o screen-match.php está localizado
* utilizo o ponto de concatenação (.) para juntar a constante mágica __DIR__ com a string '/funcoes.php', formando o caminho completo para o arquivo funcoes.php, utilizo a barra por questão de sintaxe, para facilitar a concatenação dos dois valores e garantir que o caminho esteja correto, independente do sistema operacional (Windows, Linux, etc.)
* resumindo, o __DIR__ traz a pasta do nosso arquivo atual (screen-match.php) e eu junto com a string '/funcoes.php' para formar o caminho completo do arquivo que quero incluir, garantindo que o require_once sempre encontre o arquivo funcoes.php corretamente
* estou dizendo que eu quero que ele ache esse arquivo "funcoes.php" a partir da pasta que estou execuntando meu script "screen-match.php" (arquivo que chamo o require_once)
*/
require_once __DIR__ . '/src/funcoes.php';

echo "Bem-vindo(a) ao Screen Match!" . PHP_EOL;
$escolhaDoUsuario = (int) readline("Digite o número do filme (0 a 2): ");

while ($escolhaDoUsuario < 0 || $escolhaDoUsuario > 2) {
    echo "Número inválido. Digite novamente." . PHP_EOL;
    $escolhaDoUsuario = (int) readline("Digite o número do filme (0 a 2): ");
}
// $filmes = ["Se beber, não case!", "Thor: Ragnarok", "Top Gun - Maverick"];

$filmes =
    [
        [
            "nome" => "Se beber, não case!",
            "anoLancamento" => 2011,
        ],
        [
            "nome" => "Thor: Ragnarok",
            "anoLancamento" => 2017,
        ],
        [
            "nome" => "Top Gun - Maverick",
            "anoLancamento" => 2022,
        ]
    ];

// argv é um array especial do php que guarda os argumentos passados via linha de comando (TERMINAL), separados por espaço, ou seja, ao digitar "php screen-match.php 2022", o valor 2022 estará em $argv[1] e o valor $argv[0] será o nome do arquivo "screen-match.php"
$anoLancamento = $filmes[$escolhaDoUsuario]["anoLancamento"]; // se não for passado nenhum argumento (ou seja, se for nulo), o ano de lançamento será 2022 ex: $filmes[$escolhaDoUsuario]["anoLancamento"] ?? 2022;

$quantidadeDeNotas = $argc - 1; // o valor de argc é a quantidade de argumentos passados via linha de comando (TERMINAL), incluindo o nome do arquivo, por isso subtraímos 1 para obter a quantidade real de notas (para não incluir o nome do arquivo na contagem)
$notas = [];

for ($i = 1; $i < $argc; $i++) {
    // utilizando a cionversão de tipo (type casting) para garantir que o valor seja tratado como float, pois estava me retornando string
    // notas[], sem indicar o indice que quero armazenar, pois o PHP automaticamente atribui o próximo índice disponível no array (nesse caso, o índice 0, depois o 1, e assim por diante, vai jogando pra ultima posição disponível do array)
    $notas[] = (float) $argv[$i];
}

$notaFilme = array_sum($notas) / $quantidadeDeNotas;

$planoPrime = true;
// se uma das condições forem verdadeiras, a váriavel $incluidoNoPlano será verdadeira (true), caso contrário, será falsa (false)
$incluidoNoPlano = incluidoNoPlano($planoPrime, $anoLancamento);

echo $filmes[$escolhaDoUsuario]["nome"] . PHP_EOL;
echo "Lançado em: " . $anoLancamento . " - Nota: $notaFilme" . PHP_EOL;

exibeMensagemLancamento($anoLancamento);

// match realiza uma comparação estrita (===) entre o valor da variável e os valores definidos em cada case, caso encontre um valor correspondente, ou seja, caso o valor passado como parâemetro seja igual a um dos valores definidos, o bloco de código correspondente será executado(se $nomeFilme passado nos parênteses de match for igual a um dos cases dele, como por exemplo, um dos cases dentro do bloco de código do nosso match é "Se beber, não case!" e se o valor de $nomeFilme for igual a "Se beber, não case!" ele vai retornar o valor "comédia" para a váriavel $genero), retornando o valor associado a esse case. Se nenhum valor corresponder, o bloco default será executado, retornando o valor associado a ele.
$genero =  match ($filmes[$escolhaDoUsuario]["nome"]) {
    "Se beber, não case!" => "Comédia",
    "Thor: Ragnarok" => "super-herói",
    "Top Gun - Maverick" => "Ação",
    default => "Desconhecido"
};

echo "O gênero do filme é: $genero" . PHP_EOL;
$filmesComoStringJson = json_encode($filmes);

// gravo o conteúdo JSON em um arquivo chamado filmes.json, utilizando a função file_put_contents, que recebe como primeiro parâmetro o caminho do arquivo (utilizando __DIR__ para garantir que o arquivo será criado na mesma pasta do script atual(MESMA PASTA DE SCREEN-MATCH)) e como segundo parâmetro o conteúdo a ser gravado (a string JSON gerada anteriormente)
file_put_contents(__DIR__ . '/filmes.json', $filmesComoStringJson);

$novoFilme = criaFilme("Festa da Salsicha", 2018, "Comédia", 8.0);
// outra forma de criar um filme , ignorando a ordem dos parâmetros, onde, por ex, na linha acima eu sigo a ordem, passo o nome do filme primeiro pois ele é o primeiro parâmetro da minha função construtora, porém, fazendo da forma abaixo, especificando o nome do atributo, posso passa-lo em qualquer posição dentro dos parênteses abaixo
// também utilizado quando temos parâmetros opcionais e queremos passar apenas 1 ou 2
$novoFilme2 = criaFilme(anoLancamento: 2020, nome: "365 dias", genero: "Foda demais", nota:  10.0);

// como não é mais array associativo, não se mostra mais necessário a utilização de [] para exibir um atributo da coleção, aqui, apenas utilizamos "$objetoInstanciadoDeAlgumaClasse->nomeDoAtributo;"
echo $novoFilme->nome . PHP_EOL;
echo $novoFilme->anoLancamento . PHP_EOL;

$serie = criaSerie("Arcane", 9,20.5, true);
var_dump($serie);