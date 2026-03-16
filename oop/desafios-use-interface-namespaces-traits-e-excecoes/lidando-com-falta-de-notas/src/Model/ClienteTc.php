<?php 
namespace FaltaNotas\Model;

class ClienteTc 
{
    public function __construct(public readonly string $nome, public readonly string $cpf)
    {}
}
