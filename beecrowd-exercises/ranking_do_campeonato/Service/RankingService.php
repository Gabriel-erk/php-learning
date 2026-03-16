<?php

namespace RankingCampeonato\Service;

use RankingCampeonato\Model\{Jogador, Ranking};

class RankingService
{

    public function possuiJogadores(Ranking $ranking): bool {
        $ranking = $ranking->getRankingJogadores();
        if (count($ranking) > 0 && count($ranking) < 10) {
            return true;
        } else {
            return false;
        }
    }

    public function showPrimeiroColocadoRanking(Ranking $ranking): string
    {
        $rankingJogadores = $ranking->getRankingJogadores();

        if ($this->possuiJogadores($ranking)) {
            $maiorJogador = "";
            $maiorPontuacao = 0;
            foreach ($rankingJogadores as $nomeJogador => $pontuacaoJogador) {
                if ($pontuacaoJogador > $maiorPontuacao) {
                    $maiorJogador = $nomeJogador;
                    $maiorPontuacao = $pontuacaoJogador;
                }
            }
            return "Jogador: $maiorJogador - Pontuação: $maiorPontuacao \n";
        } else {
            return "Ranking cheio ou não possui jogadores. \n";
        }
    }

    public function showPontuacaoJogador(Ranking $ranking, string $nomeJogador): string
    {
        $rankingJogadores = $ranking->getRankingJogadores();

        if (in_array($nomeJogador, $rankingJogadores)) {
            return $rankingJogadores[$nomeJogador];
        } else {
            return "Jogador não encontrado no ranking. \n";
        }
    }

    public function showInfoJogadores(Ranking $ranking): string|array
    {
        $rankingJogadores = $ranking->getRankingJogadores();

        if (count($rankingJogadores) > 0) {
            return $rankingJogadores;
        } else {
            return "Ranking não possui jogadores. \n";
        }
    }
}
