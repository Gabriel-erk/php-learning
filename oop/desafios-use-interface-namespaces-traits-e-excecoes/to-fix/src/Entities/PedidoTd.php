<?php 

namespace Fix\Entities;

use Fix\Contracts\{ProcessavelTd, LogavelTd};
use Fix\Enums\StatusPedidoTd;

abstract class PedidoTd implements ProcessavelTd, LogavelTd
{
    private array $produtos;
    private StatusPedidoTd $status;
    private float $valorTotal;

    public function __construct(ClienteTd $cliente){
        $this->produtos = [];
        $this->status = StatusPedidoTd::PENDENTE;
        $this->valorTotal = 0;
    }

    // a implementar
    public function processar(): bool{
        return true;
    }

    // a implementar
    public function log(string $mensagem):void{}

    public function adicionarProduto(ProdutoTd $produto): bool{
        $this->produtos[] = $produto;

        return True; 
    }

    private function calcularTotal(): float{
        foreach ($this->produtos as $produto) {
            $somaValorProdutos = $produto->preco;
        }
        return $somaValorProdutos;
    }

    public function getTotal(): float{
        return $this->calcularTotal();
    }

    public function getStatus(): string{
        return $this->status->name;
    }

    // a implementar
    public function cancelar(): bool{
        return true;
    }
}
