<?php 

namespace Fix\Traits;

trait LoggerTraitTd
{
    // atributo estático, logo, ele pertence a CLASSE/TRAIT (não dá para instanciar um objeto a partir de uma trait, logo, deu pra pegar o conceito aqui)
    static int $id = 0;
    public function identificadorPedidoTrait():int {
        // retornando o valor do ID do pedido
        return $this->id =+ 1;
    }
}
