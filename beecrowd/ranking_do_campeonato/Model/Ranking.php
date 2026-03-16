<?php 

namespace RankingCampeonato\Model;

class Ranking {

    private string $nomeRanking;
    private array $rankingJogadores;
    public function __construct(public readonly string $donoRanking){
        $this->nomeRanking = "=== Campeonato do $donoRanking ===";
        $this->rankingJogadores = [];
    }

    public function registraJogador(string $nomeJogador, int $pontuacaoInicial): bool{
        if (!in_array($nomeJogador, $this->rankingJogadores)) {
            $this->rankingJogadores[$nomeJogador] = $pontuacaoInicial;
            return true;
        } else {
            return false;
        }
    }

    public function addPontos(string $nomeJogador, int $pontuacaoDesejada): bool{
        if (in_array($nomeJogador, $this->rankingJogadores)) {
            $this->rankingJogadores[$nomeJogador] += $pontuacaoDesejada;
            return true;
        } else {
            return false;
        }
    }

    // feito para encapsular/proteger bem as infos da classe, será usado pelo service para tratar e devolver para o arquivo principal fazer a listagem do mesmo
    public function getRankingJogadores(): array {
        return $this->rankingJogadores;
    }
}
