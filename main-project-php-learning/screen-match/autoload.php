<?php

/* 
* conceito de autoload
* quero que quando eu executar meu código (como por exemplo, rodar este arquivo no terminal) e o php não encontre uma classe, interface, trait que está sendo usada neste arquivo, que ele procure no pedaço de código que irei informar a ele e importe automaticamente, fazendo o: autoload
* spl_autoload_register() é uma função padrão do php (como uma palavra reservada) que permite que eu registre uma função que vai tentar realizar o autoload de símbolos (classes, interfaces, traits etc)
* ela espera como argumento uma função (eu não sabia mas pelo visto no php é comum voce passar funções como parâmetro e recebê-las também)
* como estou passando uma função como parâmetro, não preciso dar um nome para ela (está sendo criada basicamente no momento da execução também)
* o parâmetro da função que estou passando de parâmetro para a função: spl_autoload_register é o nome do símbolo (nome da classe aqui)
* $className vai ter o valor do caminho da classe/símbolo, ao executar o arquivo esse spl_autoload_register já vai começar a rodar na hora (instantaneamente), seu primeiro valor vai ser o caminho até a classe "Filme" pois é a primeira que estou usando no sitema
* dentro da função que estamos passando por parâmetro ao spl, criamos uma váriavel chamada "caminho" que substitui "ScreenMatch" por "src" no parâmetro "className" que recebemos, pois, pelo menos nessa aplicação, tudo que possui um namespace está dentro da pasta "src", diminuindo o caminho e deixando a busca pelo arquivo desejado mais assertiva
* porém para que eu atinja o caminho 100% exato do meu arquivo, ainda falta a extensão ".php" que todos os arquivos php possuem, por isso, no fim, concateno o retorno da função "str_replace" (caminho do arquivo trocando ScreenMatch por src) com uma string '.php', assim por exemplo, se str_replace retornar src/Model/Filme ficará após concatenar com minha string: src/Model/Filme.php
*/
spl_autoload_register(function (string $className) {
    $caminho = str_replace("ScreenMatch", "src", $className) . '.php';
    /* 
    * agora faço um require_once (once garante que seja incluido pelo menos uma vez e se já foi antes, não inclua de novo)
    * assim incluimos TODOS os símbolos que serão utilizados passando o caminho CORRETO até eles (reduzindo os trocentos require e caso mude algum caminho, eu não tenha que altera-lo aqui)
    * __DIR__ possui o caminho desde c: até a pasta atual que estou concatenando com a minha váriavel $caminho
    * DIRECTORY_SEPARATOR é uma constante padrão do php que nos entrega o separador de diretório do nosso sistema operacional (como estamos no windows, entrega "\")
    * importante usarmos o dir para não termos problemas futuros como: "qual a base desse arquivo?" "de onde esse executavel veio?" e etc, como __DIR__ temos o caminho absoluto e sabemos da origem, de todo o caminho do arquivo que estamos colocando no nosso "require"/"require_once"
    */
    /*
    * explicando o pq da concatenação com "\" logo abaixo 
    * /src pq logo abaixo irei concatenar essa váriavel $caminho com "__DIR__" que me traz o caminho desde c: até essa pasta em que estamos, e sem essa "\" antes do src bugaria e ele não entenderia que "src" é OUTRA pasta depois da última que __DIR__ me traz
    * __DIR__ me entrega isso: c:\\dev\\php-primeiros-passos\\php-criando-sua-aplicacao\\screen-match, sem o '\' no src abaixo, ficaria: c:\\dev\\php-primeiros-passos\\php-criando-sua-aplicacao\\screen-matchsrc e não do jeito que queremos, que é acessar uma sub-pasta dentro da última pasta que ele me trouxe "screen-match", ficando c:\\dev\\php-primeiros-passos\\php-criando-sua-aplicacao\\screen-match\src 
    * como este autoload já esta chamando o diretório completo com "__DIR__", qualquer lugar que eu chama-lo irá funcionar, pois já esta na "pasta certa", no nosso caso, a pasta raiz do sistema, juntamente do executavel (index.php)
    */
    $caminhoCompleto = __DIR__ . DIRECTORY_SEPARATOR . $caminho;
    /* 
    * verificando se o arquivo existe antes de fazer um require
    * função file_exists do php verifica se o arquivo que passamos (como parâmetro \ caminho inteiro até o arquivo) existe, retornando um booleano (true,false)
    * caso ele exista, fazemos o require daquele símbolo no nosso arquivo
    * isso nos ajuda caso tenhamos a intenção de realizar vários autoload, e a estrutura dos seus caminhos seresm similares a desse autoload que estamos criando agora
    * caso não exista, ele não faz nada, pois sem esse if ele tentar executar o require com um caminho que não existe, nos trará um erro, dessa forma abaixo, executando apenas se ELE REALMENTE EXISTIR, não teremos esse tipo de problema
    * normalmente apenas UM autolaod é feito, mas caso precise de mais, a implementação já está correta para recebê-lo
    * também é importante garantir que nosso autoload não gere nenhum erro pois assim estamos alinhados com as boas práticas da PSR (PHP Standardard Recommendations 4) onde diz que nosso autoload não deve gerar erros
    */
    // var_dump($caminhoCompleto);
    if (file_exists($caminhoCompleto)) {
        require_once $caminhoCompleto;
    }
});
