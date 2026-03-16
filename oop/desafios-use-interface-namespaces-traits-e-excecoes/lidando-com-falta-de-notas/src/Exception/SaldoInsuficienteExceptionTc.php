<?php 

namespace FaltaNotas\Exception;

use Exception;

class SaldoInsuficienteExceptionTc extends Exception 
{
    public function __construct(){
        return parent::__construct("Saldo insuficiente para saque.");
    }
}
