<?php

namespace Src\Domain\Repository;

use Src\Domain\Model\Produto;

interface ProdutoRepository
{
    public function index(): array;

    public function produtosCafe(): array;

    public function produtosAlmoco(): array;

    public function findById(int $id): ?Produto;

    public function update(Produto $produto): bool;

    public function delete(Produto $produto): bool;
}