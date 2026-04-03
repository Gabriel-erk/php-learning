<?php 

namespace Fix\Entities;

class PedidoDigitalTd extends PedidoTd
{
    public function __construct(ClienteTd $cliente) {
        parent::__construct($cliente);
    }

    public function valorTotal(): void {
        // preciso que o valor do meu atributo "valorTotal" esteja atualizado, preciso que seu valor no momento da execução deste método aqui, seja realmente o TOTAL, pois posso chama-lo quando eu NUNCA disparei o método que calcula o total de todos os produtos no meu pedido, logo, o valor de valorTotal seria 0, pois eu NUNCA calculei o total das coisas
        $this->calcularTotal();
        // 0.10 == 10%
        $porcentagemDesconto = 0.10;
        if ($this->valorTotal > 100) {
            $valorDesconto = $this->valorTotal / $porcentagemDesconto;
            $this->valorTotal -= $valorDesconto;
        }
        
    }
}
