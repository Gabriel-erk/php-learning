<?php 

// aprendemos no curso anterior como funciona um autoload e como cria-lo, aqui precisamos utilizar algumas classes em outros namespaces, como "Client" (no namespace GuzzleHttp\Client) e "Crawler" (no namespace Symfone\Component\DomCrawler\Crawler) que, assim como nos outros cursos e exercicios, precisavamos fazer um require dos arquivos onde estão essas classes, porém, imagina um projeto grande? seria bem complexo de manter com diversos require, coisa que o autoload já resolve, aprendemos o funcionamento dele antes e não precisamos criar dessa vez, pois dentro de "vendor" já nos retorna um autoload para simplesmente fazermos o require para nossa aplicação atual e ele conseguir importar todos os simbolos (classe, trait...)que precisamos apenas importando ele, logo, ao ler a linha 5 (use GuzzleHttp\Client) ele já fará o require da mesma para nos, sem a necessidade de nos mesmos procurarmos o "GuzzleHttp\Client" e colocarmos manualmente o require aqui (ainda mais nesse projeto que temos DEZENAS de pastas, seria realmente complicado de manter uma grande quantia de require's)
require_once "vendor/autoload.php";
// namespace que está a classe "client" que queremos usar!
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client();
// variavel resposta recebe o retorno do método "request" que o objeto do tipo client usa, onde passamos como parâmetro o método (GET) e a url que iremos buscar as nossas informações
$resposta = $client->request('GET', 'https://www.alura.com.br/cursos-online-programacao/php');

// pegando o corpo do html, literalmente, todo o conteúdo escrito na linguagem de marcação HTML
$html = $resposta->getBody();

// instanciando um objeto do tipo crawler sem passar nada para o construtor
$crawler = new Crawler();
// classe Crawler permite passar um html como parâmetro na inicialização dele (na linha acima: $crawler = new Crawler($poderiaPassarHTMlaqui)), porém também podemos adiciona-lo ao $crawler da maneira abaixo chamando o método addHtmlContent($htmlAqui)
$crawler->addHtmlContent($html);

// filtrando o conteúdo do html usando o método filter() do crawler, onde passamos como parâmetro o seletor CSS que queremos buscar, no caso, estamos buscando por todos os elementos que possuem a classe "card-curso__nome" - explicação IA
// não queremos a página inteira, não quero o HTML todo e fazer uma lista em todos os elementos, quero apenas os nomes dos cursos
// coisa que temos acesso ao selecionar o card do curso na página que iremos filtrar e inspecionarmos ele, que nos mostra a seguinte classe: card-curso__nome dentro e um span (como a estrutura no site nos mostra)
// com isso podemos chamar o método filter do nosso crawler para trazer apenas o conteúdo que possua essa classe (card-curso__nome) onde indicamos que é uma classe pois antes de citar o seu nome, colocamos o "." e antes disso o "span" para indicar em qual tag HTML essa classe está inserida
// por fim, todo o processo acima é passado para nossa nova variável "$cursos", onde teoricamente possui os nomes de todos os cursos com a classe card-curso__nome dentro de um span
$cursos = $crawler->filter('span.card-curso__nome');

