<x-layout title="Visualizar - Produto">
    <div class="mt-5">

        <!-- Título -->
        <div class="mb-4">
            <h1 class="fw-bold">{{ $produto['nome'] }}</h1>
            <p class="text-muted">{{ $produto['preco'] }}</p>
        </div>

        <!-- Card -->
        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="card-title mb-4">Informações</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nome:</strong>
                        <p>{{ $produto['nome'] }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Preço:</strong>
                        <p>{{ $produto['preco'] }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Descrição:</strong>
                        <p>{{ $produto['descricao'] }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Status:</strong>
                        <p>{{ $produto['ativo'] }}</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Botões -->
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('produtos.edit', $produto['id']) }}" class="btn btn-primary">
                Editar
            </a>

            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">
                Voltar
            </a>
        </div>

    </div>
</x-layout>
