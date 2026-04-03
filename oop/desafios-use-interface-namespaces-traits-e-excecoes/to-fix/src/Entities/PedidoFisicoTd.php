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
        // sem () para dar prioridade a alguma operação pois a divisão (/) na "cadeia alimetar" de execução das operações, já vem primeiro, logo, ela será executada antes da soma (como desejamos)
        $totalPedido = $this->getTotal() / 0.5 + self::FRETE;

        if ($this->getTotal()) {
            # code...
        }
        return 0.0;
    }
}
