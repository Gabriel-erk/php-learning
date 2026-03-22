<x-layout title="Home">
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex align-items-center justify-content-between">
                {{ $serie->nome }}
                <a href="/series/editar/{{ $serie->id }}" class="btn btn-dark">Editar</a>
            </li>
        @endforeach
    </ul>
</x-layout>
