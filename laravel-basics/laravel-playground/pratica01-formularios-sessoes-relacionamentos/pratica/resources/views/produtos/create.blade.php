<x-layout title="Cadastro - Produtos">

    <div id="titulo" class="d-flex justify-content-between mb-3">
        <h2>Cadastro de Produtos</h2>
    </div>

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome"
                placeholder="Informe o nome do produto">
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco"
                placeholder="Informe o preço do produto">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" placeholder="Informe a descrição do produto"></textarea>
        </div>

        <div class="mb-3">
            <label for="ativo" class="form-label">Status</label>
            <input type="number" class="form-control" id="ativo" name="ativo" placeholder="Informe o status do produto">
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</x-layout>
