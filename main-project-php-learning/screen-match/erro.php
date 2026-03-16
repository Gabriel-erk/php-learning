<?php
// como comentado em outro arquivo, seguindo a psr-4 (php standard recommendations) nosso autoload não deve retornar nenhum tipo de erro, porém, caso isso aconteça, como iremos saber? como lidar com isso? e essa vai ser a responsabilidade deste arquivo aqui

use ScreenMatch\Calculos\ConversorNotaEstrela;
use ScreenMatch\Exception\NotaInvalidaException;
use ScreenMatch\Model\Episodio;
use ScreenMatch\Model\Genero;
use ScreenMatch\Model\Serie;

require_once 'autoload.php';

$serie = new Serie("Nome da série", 2000, Genero::Acao, 10, 20, 50);
$episodio = new Episodio($serie, "Título do episódio", 1);
try {
    $episodio->avalia(-25);
    $conversor = new ConversorNotaEstrela();
    echo $conversor->converte($episodio);
} // não precisei usar "\"  antes da minha Exception no parâmetro e nem o "use" no topo do arquivo pois se pararmos para ver, este arquivo não está em nenhum namespace E estamos na pasta raiz do sistema (screen match) que é onde o namespace "raiz"/"padrão" do php se encontra que é justamente onde a classe "Exception" se encontra (não so ela, mas como várias outras que estão no namespace padrão do php: Throwable, Error...etc) 
catch (NotaInvalidaException $e) {
    echo "Um problema aconteceu: " . $e->getMessage();
}
