<?php
namespace InventarioCasaAbandonada\Model;
class ItemEcontrado
{
    public function __construct(public readonly string $nome, public readonly string $comodo, public readonly string $nivelPerigo)
    {
    }
}
