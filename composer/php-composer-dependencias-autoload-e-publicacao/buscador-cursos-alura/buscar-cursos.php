<?php 
// namespace que está a classe "client" que queremos usar!
use GuzzleHttp\Client;

$client = new Client();
// variavel resposta recebe o retorno do método "request" que o objeto do tipo client usa, onde passamos como parâmetro o método (GET) e a url que iremos buscar as nossas informações
$resposta = $client->request('GET', 'https://www.alura.com.br/cursos-online-programacao/php');

$html = $resposta->getBody();