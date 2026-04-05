<?php 

namespace Fix\Entities;

class ProdutoTd 
{
    static int $id = -1;
    // regra básica: preço do produto precisa ser maior que 0
    public function __construct(readonly public string $nome, readonly public float $preco){
        $this->id += 1;
    }

    public function setPreco($novoPreco){
        $this->preco = $novoPreco;
    }
}
