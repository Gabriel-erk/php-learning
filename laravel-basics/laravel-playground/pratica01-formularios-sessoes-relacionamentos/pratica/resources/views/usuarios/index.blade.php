<x-layout title="Home - Usuários">
    @isset($mensagemStatus)
        <div class="alert alert-success mb-2">
            {{ $mensagemStatus }}
        </div>
    @endisset

    <div id="titulo" class="d-flex justify-content-between mb-3">
        <h2>Listagem de Usuários</h2>

        <a class="btn btn-primary" href="{{ route('usuarios.create') }}">Add</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped-columns table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    {{-- <th scope="col">Sobrenome</th> --}}
                    <th scope="col">E-mail</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <th scope="row">{{ $usuario->id }}</th>
                        <td>{{ $usuario->nome }}</td>
                        {{-- <td>{{ $usuario->sobrenome }}</td> --}}
                        <td>{{ $usuario->email }}</td>
                        <td class="d-flex flex-column flex-md-row gap-2 justify-content-md-between align-items-center">
                            <a class="btn btn-primary" href="{{ route('usuarios.edit', $usuario->id) }}">Edit</a>
                            <a class="btn btn-primary" href="{{ route('usuarios.show', $usuario->id) }}">View</a>
                            <form action="
                            {{ route('usuarios.destroy', $usuario->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Del</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
