<x-layout title="Home">
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex align-items-center justify-content-between">
                {{ $serie->nome }}
                <div id="botoes" class="d-flex gap-2">
                    <form action="/series/deletar/{{ $serie->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>

                    <a href="/series/editar/{{ $serie->id }}" class="btn btn-dark">Editar</a>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>
