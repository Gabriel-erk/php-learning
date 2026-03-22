<x-layout title="Editar">
    <form action="/series/atualizar/{{ $serie->id }}" method="post">
        @csrf
        {{-- html só permite métodos get e post, e a linha abaixo permite forçar um "put" == método de atualização de registro no db --}}
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Novo nome da série:</label>
            <input type="text" class="form-control" name="nome" value ="{{ $serie->nome }}">
        </div>

        <button type="submit" class="btn btn-dark">Atualizar</button>
    </form>
</x-layout>
