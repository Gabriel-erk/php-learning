<?php

namespace Fix\Entities;

use Fix\Contracts\TributavelTd;

class PedidoFisicoTd extends PedidoTd implements TributavelTd
{
    public const FRETE = 20.00;

    public function __construct(ClienteTd $cliente)
    {
        return parent::__construct($cliente);
    }

    public function calcularTaxa(): float
    {
        $this->calcularTotal();
        return $this->valorTotal / 0.5 + self::FRETE;
    }
    
    public function valorTotal(): void
    {
        // sem () para dar prioridade a alguma operação pois a divisão (/) na "cadeia alimetar" de execução das operações, já vem primeiro, logo, ela será executada antes da soma (como desejamos)
        $taxaPedido = $this->calcularTaxa();
        $this->valorTotal -= $taxaPedido;
    }
}
