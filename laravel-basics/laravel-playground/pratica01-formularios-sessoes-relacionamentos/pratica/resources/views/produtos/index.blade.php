<x-layout title="Home - Produtos">
    @isset($mensagemStatus)
        <div class="alert alert-success mb-2">
            {{ $mensagemStatus }}
        </div>
    @endisset

    <div id="titulo" class="d-flex justify-content-between mb-3">
        <h2>Listagem de Produtos</h2>

        <a class="btn btn-primary" href="{{ route('produtos.create') }}">Add</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped-columns table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produtos as $produto)
                    <tr>
                        <th scope="row">{{ $produto->id }}</th>
                        <td>{{ $produto->nome }}</td>
                        <td>{{ $produto->preco }}</td>
                        <td>{{ $produto->ativo }}</td>
                        <td class="d-flex flex-column flex-md-row gap-2 justify-content-md-between align-items-center">
                            <a class="btn btn-primary" href="{{ route('produtos.edit', $produto->id) }}">Edit</a>
                            <a class="btn btn-primary" href="{{ route('produtos.show', $produto->id) }}">View</a>
                            <form action="
                            {{ route('produtos.destroy', $produto->id) }}"
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
