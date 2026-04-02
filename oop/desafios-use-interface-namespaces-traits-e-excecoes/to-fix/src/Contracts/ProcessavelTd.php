<?php 

namespace Fix\Contracts;

interface ProcessavelTd 
{
    // método público abstrato (é abstrato por estar em uma interface) e que retorna um valor booleano, toda classe que implementar essa interface (ela não sendo abstrata, terá que fazer a implementação (== definição do corpo) deste método)
    public function processar(): bool;
}
