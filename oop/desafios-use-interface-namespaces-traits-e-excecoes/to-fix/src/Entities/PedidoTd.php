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
    private float $valorTotal;

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
