<?php 

namespace Practice\Exceptions;

use Exception;

class ValorInvalidoException extends Exception 
{
    public function __construct(){
        return parent::__construct("Valor Inválido - Não foi possível realizar esta operação.");
    }
}
