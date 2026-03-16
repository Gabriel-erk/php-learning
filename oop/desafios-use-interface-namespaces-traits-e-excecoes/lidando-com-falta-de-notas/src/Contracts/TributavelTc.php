<?php 
namespace FaltaNotas\Contracts;

// somente conta corrente implementa esta aqui
// única função dessa interface é forçar a classe que a for implementar a calcular a taxa (contaCorrente no caso)
interface TributavelTc{
    // definição do método da interface TEM que ser público e na hora de sua implementação também
    public function calcularTaxa(float $valor): float;
}