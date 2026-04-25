<x-layout title="Home - Usuários">
    @isset($mensagemStatus)
        <div class="alert alert-success">
            {{ $mensagemStatus }}
        </div>
    @endisset

    <ul class="list-group">
        <table class="table table-striped-columns table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Sobrenome</th>
                    <th scope="col">E-mail</th>aaa
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <th scope="row">{{ $usuario->id }}</th>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->sobrenome }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td class="d-flex justify-content-between align-items-center">
                            <button class="btn btn-primary">Editar</button>
                            <form action="
                            {{ route('usuarios.destroy', $usuario->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </ul>
</x-layout>
