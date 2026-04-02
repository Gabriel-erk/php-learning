<?php 

namespace Fix\Entities;

class PedidoDigitalTd extends PedidoTd
{
    public function __construct(ClienteTd $cliente) {
        parent::__construct($cliente);
    }
}
