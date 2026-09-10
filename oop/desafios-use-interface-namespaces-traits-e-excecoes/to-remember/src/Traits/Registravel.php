<?php

namespace Practice\Traits;

trait Registravel
{
    public function registrarOperacao(string $mensagem, float $valor)
    {
        // saque, depósito e aplicação de rendimento
        return $mensagem . $valor;
    }
}
