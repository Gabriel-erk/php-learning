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
            <input type="tel" class="form-control" id="duracaoEmMinutos" name="duracaoEmMinutos"
                placeholder="Duração em minutos">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>
