<?php 

namespace Practice\Exceptions;

use Exception;

class SaldoInsuficienteException extends Exception 
{
    public function __construct() {
        return parent::__construct("Saldo Insuficiente - Não foi possível realizar esta operação.");
    }
}
