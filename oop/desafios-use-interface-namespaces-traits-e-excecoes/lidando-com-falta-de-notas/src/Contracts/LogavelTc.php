<?php 
namespace FaltaNotas\Contracts;

interface LogavelTc{
    public function log(string $mensagem): void;
}