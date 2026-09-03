<?php 

namespace Practice\Traits;

trait Registravel {
    private array $operacoes = [];
    public function registrarOperacao(int $idConta, string $mensagem): string {
        
        // $this->operacoes[] = [$idConta, $mensagem];
        return "";
    }
}