<x-layout title="Visualizar - Filme">
    <div class="mt-5">

        <!-- Título -->
        <div class="mb-4">
            <h1 class="fw-bold">{{ $filme['nome'] }}</h1>
            <p class="text-muted">{{ $filme['genero'] }}</p>
        </div>

        <!-- Card -->
        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="card-title mb-4">Informações</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nome:</strong>
                        <p>{{ $filme['nome'] }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Genêro:</strong>
                        <p>{{ $filme['genero'] }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Duração em minutos:</strong>
                        <p>{{ $filme['duracaoEmMinutos'] }}</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Botões -->
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('filmes.edit', $filme['id']) }}" class="btn btn-primary">
                Editar
            </a>

            <a href="{{ route('filmes.index') }}" class="btn btn-secondary">
                Voltar
            </a>
        </div>

    </div>
</x-layout>
