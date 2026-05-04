<form action="{{ $action }}" method="post">
    @csrf
    {{-- se o campo nome existe, é pq é uma atualização, e caso seja uma atualização, ele insere o método PUT --}}
    @isset($nome)
        @method('PUT')
    @endisset
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" class="form-control" {{-- SE EXISTIR/SE TIVER VALOR o campo "atributo 'nome' dentro do objeto série, ele exibe", se não, não exibe, pq? pq esse campo só terá valor no página de edição de série, no formulário de cadastro, não, assim podemos reutilizar o formulário de forma eficiente --}}
            @isset($nome) value="{{ $nome }}"@endisset />
    </div>
    <button type="submit" class="btn btn-dark">Adicionar</button>
</form>
