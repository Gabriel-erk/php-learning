<?php 

class Cliente 
{
    public function __construct(private string $nome, private string $cpf)
    {
    }
    
    public function getNome(): string{
        return $this->nome;
    }

    public function getCpf(): string{
        return $this->cpf;
    }
}
