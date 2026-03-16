<?php 

require_once __DIR__ . DIRECTORY_SEPARATOR . "autoload.php";

use PlaylistInteligente\Model\Musica;
use PlaylistInteligente\Service\PlaylistService;

echo "=== Criando Músicas ===\n";
$musicaUm = new Musica("Enemy", "Imagine Dragons", 5, "Pop");
$musicaDois = new Musica("When we", "Tank", 4, "R&B");
$musicaTres = new Musica("I think he knows", "Taylor Swift", 3, "Pop");
$musicaQuatro = new Musica("Don't", "Bryson Tiller", 3, "R&B");
$musicaCinco = new Musica("Woman", "Doja cat", 4, "Pop");
$musicaSeis = new Musica("Enter sandman", "Metallica", 6, "Rock");

// criando playlist
$service = new PlaylistService();
$playlist = $service->createPlaylist("Playlist do g.azin");

echo "=== Adicionando músicas a playlist ===\n";
echo $service->addMusica($playlist, $musicaUm);
echo $service->addMusica($playlist, $musicaDois);
echo $service->addMusica($playlist, $musicaTres);
echo $service->addMusica($playlist, $musicaQuatro);
echo $service->addMusica($playlist, $musicaCinco);
echo $service->addMusica($playlist, $musicaSeis);

echo "\n";

echo "=== Removendo música ===\n";
echo $service->removerMusica($playlist, $musicaCinco->nomeMusica);

echo "\n";

echo "=== Tempo total da playlist ===\n";
echo $service->tempoTotalPlaylist($playlist);

echo "\n";
echo "=== Tempo total por genêro === \n";
echo $service->tempoPorGenero($playlist);