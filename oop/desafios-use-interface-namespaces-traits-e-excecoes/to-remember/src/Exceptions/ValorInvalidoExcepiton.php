<?php 

namespace Practic\Exceptions;

use Exception;

class ValorInvalidoExcepiton extends Exception 
{
    public function __construct(){
        return parent::__construct("Valor Inválido - Não foi possível realizar esta operação.");
    }
}
