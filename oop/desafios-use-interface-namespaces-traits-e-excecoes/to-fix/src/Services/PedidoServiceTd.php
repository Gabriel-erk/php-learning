<?php 

namespace Fix\Services;
use Fix\Entities\{PedidoTd, ProdutoTd};

class PedidoServiceTd 
{
    // cria um novo objeto do tipo pedido, podendo ser "fisico" ou "digital"
    public function criarPedido(){

    }

    // adiciona produto ao pedido
    public function adicionarProduto(PedidoTd $pedido, ProdutoTd $produto): string{

        $pedido->adicionarProduto($produto);
        return "Peidido adicionado com sucesso.";
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
