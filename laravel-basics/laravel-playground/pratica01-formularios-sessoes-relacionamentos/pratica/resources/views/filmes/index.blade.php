<x-layout title="Home - Filmes">
    @isset($mensagemStatus)
        <div class="alert alert-success mb-2">
            {{ $mensagemStatus }}
        </div>
    @endisset

    <div id="titulo" class="d-flex justify-content-between mb-3">
        <h2>Listagem de Filmes</h2>

        <a class="btn btn-primary" href="{{ route('filmes.create') }}">Add</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped-columns table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Genêro</th>
                    <th scope="col">Minutagem</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filmes as $filme)
                    <tr>
                        <th scope="row">{{ $filme->id }}</th>
                        <td>{{ $filme->nome }}</td>
                        <td>{{ $filme->genero }}</td>
                        <td>{{ $filme->duracaoEmMinutos }}</td>
                        <td class="d-flex flex-column flex-md-row gap-2 justify-content-md-between align-items-center">
                            <a class="btn btn-primary" href="{{ route('filmes.edit', $filme->id) }}">Edit</a>
                            <form action="
                            {{ route('filmes.destroy', $filme->id) }}"
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
