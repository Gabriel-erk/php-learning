<x-layout title="Home - Usuários">
    @isset($mensagemStatus)
        <div class="alert alert-success">
            {{ $mensagemStatus }}
        </div>
    @endisset

    <ul class="list-group">
        @foreach ($usuarios as $usuario)
            <li class="list-group-item d-flex align-items-center justify-content-between">
                
            </li>
        @endforeach
    </ul>
</x-layout>
