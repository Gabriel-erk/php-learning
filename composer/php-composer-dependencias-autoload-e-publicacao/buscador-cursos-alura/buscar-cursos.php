<?php 
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
