<x-layout title="Cadastro - Filmes">

    <div id="titulo" class="d-flex justify-content-between mb-3">
        <h2>Cadastro de Filmes</h2>
    </div>

    <form action="{{ route('filmes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Genêro</label>
            <input type="text" class="form-control" id="genero" name="genero" placeholder="Genêro">
        </div>

        <div class="mb-3">
            <label for="duracaoEmMinutos" class="form-label">Duração em minutos</label>
            <input type="number" class="form-control" id="duracaoEmMinutos" name="duracaoEmMinutos"
                placeholder="Duração em minutos">
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('filmes.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </form>
</x-layout>
