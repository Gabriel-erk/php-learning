<?php 

namespace Practice\Traits;

trait Registravel {
    private array $operacoes = [];
    public function registrarOperacao( string $mensagem) {        
        $this->operacoes[] = $mensagem;
    }

    public function historico(): array
    {
        return $this->operacoes;
    }
}