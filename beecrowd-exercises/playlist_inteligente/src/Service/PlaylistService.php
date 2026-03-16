<?php

namespace PlaylistInteligente\Service;

use PlaylistInteligente\Model\Musica;
use PlaylistInteligente\Model\Playlist;

class PlaylistService
{

    public function createPlaylist(string $nomePlaylist): Playlist {
       return $playlist = new Playlist($nomePlaylist);
    }

    public function addMusica(Playlist $playlist, Musica $musica): string
    {
        if ($playlist->addMusica($musica)) {
            return "Música: " . $musica->nomeMusica . " adicionada a playlist: " . $playlist->nomePlaylist . " com sucesso! \n";
        } else {
            return "Música não foi adicionada. \n";
        }
    }

    public function removerMusica(Playlist $playlist, string $nomeMusica): string
    {
        if ($playlist->removerMusica($nomeMusica)) {
            return "Música: " . $nomeMusica . " removida da playlist: " . $playlist->nomePlaylist . " com sucesso \n";
        } else {
            return "false = Música não foi encontrada. \n";
        }
    }

    public function listarMusicas(Playlist $playlist): void
    {
        $lista_musicas = $playlist->getMusicas();
        $contadorMusicas = 1;

        if ($lista_musicas != null) {
            foreach ($lista_musicas as $musica) {
                echo "Música #00" . $contadorMusicas . " - " . $musica->nomeMusica . "\n";
                $contadorMusicas += 1;
            }
        } else {
            echo "Playlist não possui músicas \n";
        }
    }

    public function tempoTotalPlaylist(Playlist $playlist): string
    {
        return "A Playlist: " . $playlist->nomePlaylist . " possui " . $playlist->tempoTotalPlaylist() . " minutos de duração. \n";
    }

    public function tempoPorGenero(Playlist $playlist): void
    {
        $listaMusicas = $playlist->getMusicas();
        $listaGeneros = [];
        $somaTempoPorGenero = 0;

        foreach ($listaMusicas as $musica) {
            if (!in_array($musica->generoMusical, $listaGeneros)) {
                $listaGeneros[] = $musica->generoMusical;
            }
        }

        foreach ($listaGeneros as $genero) {
            foreach ($listaMusicas as $musica) {
                if ($genero == $musica->generoMusical) {
                    $somaTempoPorGenero += $musica->duracaoEmMinutos;
                }
            }
            echo "Genêro: $genero possui $somaTempoPorGenero minutos de duração. \n";
            $somaTempoPorGenero = 0;
        }
    }
}
