<x-layout title="Edição de Série">
    <form action="{{ route('series.update', $series->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ $series->nome }}">
        </div>
        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>
