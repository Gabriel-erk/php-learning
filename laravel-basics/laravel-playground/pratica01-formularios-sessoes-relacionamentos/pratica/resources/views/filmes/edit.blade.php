<x-layout title="Cadastro - Filmes">

    <div id="titulo" class="d-flex justify-content-between mb-3">
        <h2>Atualização de Filmes</h2>
    </div>

    <form action="{{ route('filmes.update', $filme['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $filme['nome'] }}">
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Genêro</label>
            <input type="text" class="form-control" id="genero" name="genero" value="{{ $filme['genero'] }}">
        </div>

        <div class="mb-3">
            <label for="duracaoEmMinutos" class="form-label">Duração em minutos</label>
            <input type="number" class="form-control" id="duracaoEmMinutos" name="duracaoEmMinutos"
                value="{{ $filme['duracaoEmMinutos'] }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>
