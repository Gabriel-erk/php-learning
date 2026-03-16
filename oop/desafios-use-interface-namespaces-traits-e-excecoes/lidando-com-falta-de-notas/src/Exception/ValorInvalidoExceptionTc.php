<?php

namespace FaltaNotas\Exception;

use Exception;

class ValorInvalidoExceptionTc extends Exception
{
    public function __construct()
    {
        parent::__construct("Valor inválido para esta operação.");
    }
}
