<x-layout title="Atualização - Produtos">

    <div id="titulo" class="d-flex justify-content-between mb-3">
        <h2>Atualização de Produtos</h2>
    </div>

    <form action="{{ route('produtos.update', $produto['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $produto['nome'] }}">
        </div>

        <div class="mb-3">
            <label for="preco" class="form-label">Preço</label>
            <input type="number" step="0.01" class="form-control" id="preco" name="preco"
                value="{{ $produto['preco'] }}">
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="descricao" name="descricao" value="{{ $produto['descricao'] }}"></textarea>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="ativo" value="1" {{ $produto['ativo'] == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">
                Ativo
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="ativo" value="0" {{ $produto['ativo'] == 0 ? 'checked' : '' }}>
            <label class="form-check-label" for="ativo">
                Inativo
            </label>
        </div>

        <div class="mt-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</x-layout>
