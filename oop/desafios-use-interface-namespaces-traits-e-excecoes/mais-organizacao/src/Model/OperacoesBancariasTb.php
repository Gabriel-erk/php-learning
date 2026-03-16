<?php
namespace MaisOrganizacao\Model;

interface OperacoesBancariasTb
{
    // métodos que serão obrigatórios nas classes que implementarem esta interface
    public function depositar(float $valor): bool;

    public function sacar(float $valor): bool;
}
