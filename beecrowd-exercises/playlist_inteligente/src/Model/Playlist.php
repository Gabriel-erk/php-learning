<?php 
namespace PlaylistInteligente\Model;

class Playlist 
{
    private array $listaMusicas;
    public function __construct(readonly public string $nomePlaylist){
        $this->listaMusicas = [];
    }

    // classe/simbolo música está no mesmo namespace dessa classe (playlist), logo, nao preciso do use lá em cima
    public function addMusica(Musica $musica): bool{
        $this->listaMusicas[] = $musica;
        return true;
    }

    public function removerMusica(string $nomeMusica): bool {
        for ($i=0; $i < count($this->listaMusicas); $i++) { 
            if ($this->listaMusicas[$i]->nomeMusica == $nomeMusica) {
                // unset remove dentro da lista músicas no indice que passei por parametro "$i"
                unset($this->listaMusicas[$i]);
                // unset bagunça os itens da lista, logo, removendo o indice 1, ficará as posições: 0,2,3...e array values passando a lista organiza isso para mim
                array_values($this->listaMusicas);
                return true;
            } 
        }
        return false;
    }

    // listagem é função do service
    public function getMusicas(): array {
        return $this->listaMusicas;
    }

    public function tempoTotalPlaylist(): int {
        $somaDuracaoEmMinutos = 0;
        foreach ($this->listaMusicas as $musica) {
            $somaDuracaoEmMinutos += $musica->duracaoEmMinutos;
        }
        return $somaDuracaoEmMinutos;
    }

}
