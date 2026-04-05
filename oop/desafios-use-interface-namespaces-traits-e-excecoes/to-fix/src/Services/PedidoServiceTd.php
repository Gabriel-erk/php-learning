<?php 

namespace Fix\Services;
use Fix\Entities\{PedidoTd, PedidoFisicoTd, PedidoDigitalTd, ProdutoTd, ClienteTd};

class PedidoServiceTd 
{
    // cria um novo objeto do tipo pedido, podendo ser "fisico" ou "digital"
    public function criarPedido(string $tipoPedido, ClienteTd $cliente): PedidoTd{
        if ($tipoPedido == "Fisico") {
            return new PedidoFisicoTd($cliente);
        } else {
            return new PedidoDigitalTd($cliente);
        }
    }

    // adiciona produto ao pedido
    public function adicionarProduto(PedidoTd $pedido, ProdutoTd $produto): string{
        // ao verificar a condição, o método já é executado, ou seja, se retornar true, significa que o produto foi sim adicionado, eu não preciso repetir a linha: $pedido->adicionarProduto($produto) pois ele já foi adicionado na verificação do if, a linha JÁ foi executada
        if ($pedido->adicionarProduto($produto)) {
            return "Peidido adicionado com sucesso.";
        }
        else {
            return "Não foi posssível adicionar o produto ao pedido.";
        }
        
    }

    public function processarPedido(){

    }

    public function cancelarPedido(){

    }

    public function listarPedidos(){

    }

    public function calculoFaturamentoToal(){
        
    }
}
