<x-layout title="Visualizar - Usuário">
    <div class="mt-5">

        <!-- Título -->
        <div class="mb-4">
            <h1 class="fw-bold">{{ $usuario['nome'] }} {{ $usuario['sobrenome'] }}</h1>
            <p class="text-muted">{{ $usuario['email'] }}</p>
        </div>

        <!-- Card -->
        <div class="card shadow-sm">
            <div class="card-body">

                <h5 class="card-title mb-4">Informações</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nome:</strong>
                        <p>{{ $usuario['nome'] }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Sobrenome:</strong>
                        <p>{{ $usuario['sobrenome'] }}</p>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p>{{ $usuario['email'] }}</p>
                    </div>

                    <div class="col-md-6">
                        <strong>Celular:</strong>
                        <p>{{ $usuario['celular'] }}</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Botões -->
        <div class="mt-4 d-flex gap-2">
            <a href="{{ route('usuarios.edit', $usuario['id']) }}" class="btn btn-primary">
                Editar
            </a>

            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">
                Voltar
            </a>
        </div>

    </div>
</x-layout>
