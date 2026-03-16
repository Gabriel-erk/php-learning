<?php
namespace MaisOrganizacao\Model;

class ClienteTb
{
    // readonly atingirá o objetivo que o chat está pedindo, ele não podera ser alterado depois de criado e devido a esta mesma palavra reservada não precisamos do método publico get pois esses 2 atributos já são publicos (porem não podem ser modificados)
    public function __construct(public readonly string $nome, public readonly string $cpf) {}
}
