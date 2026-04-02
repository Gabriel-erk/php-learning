<?php 

namespace Fix\Contracts;

interface Logavel {
    public function log(string $mensagem): void;
}