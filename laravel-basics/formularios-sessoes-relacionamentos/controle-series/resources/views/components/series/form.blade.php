{{-- SE houver ALGUM ou QUALQUER erro/dado, ele entra no if e exibe todos os erros pra mim --}}
{{--  --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{-- $errors é UM OBJETO (MessageBag), ou seja, nao posso trata-lo como uma lista como eu estava fazendo antes ($error as $error), pois ele nao é uma lista para eu tratá-lo assim, logo, preciso pegar TODOS os erros em forma de lista, onde o método ->all() faz isso por nós, assim permitindo que eu a trate como uma lista finalmente  --}}
            @foreach ($errors->all() as $error)    
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
