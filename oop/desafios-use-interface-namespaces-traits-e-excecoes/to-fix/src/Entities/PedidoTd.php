<?php 

namespace Fix\Entities;

use Fix\Contracts\{ProcessavelTd, LogavelTd};
use Fix\Enums\StatusPedidoTd;
use Fix\Traits\LoggerTraitTd;

abstract class PedidoTd implements ProcessavelTd, LogavelTd
{
    use LoggerTraitTd;
    private int $id;
    private array $produtos;
    private StatusPedidoTd $status;
    // protected pois classes filhas PRECISAM acessar esse valor para altera-lo depois
    protected float $valorTotal;

    // sem algum modificador de acesso (readonly,public,private...) o atributo não tem seu valor atribuido automaticamente no momento da instancia de um objeto do tipo "PedidoTd"
    public function __construct(readonly ClienteTd $cliente){
        $this->id = $this->identificadorPedidoTrait();
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
        if ($produto->preco > 0) {
            $this->produtos[] = $produto;
            return true;
        }
        return false; 
    }

    public function calcularTotal(): void{
        foreach ($this->produtos as $produto) {
            $somaValorProdutos = $produto->preco;
        }
        $this->valorTotal = $somaValorProdutos;
    }

    public function getTotal(): float{
        return $this->valorTotal;
    }

    public function getStatus(): string{
        return $this->status->name;
    }

    // a implementar
    public function cancelar(): bool{
        // se ele não foi pago e JÁ não foi cancelado, ainda é válido cancela-lo
        if ($this->status != StatusPedidoTd::CANCELADO && $this->status != StatusPedidoTd::PAGO) {
            $this->status = StatusPedidoTd::CANCELADO;
            return true;
        }
        return false;
    }
}
