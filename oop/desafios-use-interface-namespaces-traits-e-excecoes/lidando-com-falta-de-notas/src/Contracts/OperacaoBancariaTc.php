<?php 
namespace FaltaNotas\Contracts;

interface OperacaoBancariaTc {
    // é como se fosse um método abstrato, não possui corpo, apenas nome, parâmetro (opcional) e tipo de retorno, a implementação é de responsabilidade de quem implementar esta interface
    public function sacar(float $valor): bool;
    public function depositar(float $valor): bool;
}