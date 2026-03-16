<?php 
namespace PlaylistInteligente\Model;

class Musica 
{
    public function __construct(readonly public string $nomeMusica, readonly public string $nomeArtista, readonly public int $duracaoEmMinutos, readonly public string $generoMusical){
    }
}
