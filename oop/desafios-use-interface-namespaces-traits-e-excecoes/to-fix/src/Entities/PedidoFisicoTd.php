<?php

namespace Fix\Entities;

use Fix\Contracts\TributavelTd;

class PedidoFisicoTd extends PedidoTd implements TributavelTd
{

    public function __construct(ClienteTd $cliente)
    {
        return parent::__construct($cliente);
    }
    
    public function calcularTaxa(): float
    {
        return 0.0;
    }
}
