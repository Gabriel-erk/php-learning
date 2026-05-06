{{-- SE houver ALGUM ou QUALQUER erro/dado, ele entra no if e exibe todos os erros pra mim --}}
{{--  --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            {{-- $errors é UM OBJETO (MessageBag, que possui TODOS os erros de validaćão), ou seja, nao posso trata-lo como uma lista como eu estava fazendo antes ($error as $error), pois ele nao é uma lista para eu tratá-lo assim, logo, preciso pegar TODOS os erros em forma de lista, onde o método ->all() faz isso por nós, assim permitindo que eu a trate como uma lista finalmente  --}}
            @foreach ($errors->all() as $error)    
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ $action }}" method="post">
    @csrf
    {{-- se o campo nome existe, é pq é uma atualização, e caso seja uma atualização, ele insere o método PUT --}}
    {{-- @isset($nome) --}}
        {{-- @method('PUT') --}}
    {{-- @endisset --}}
    {{-- em nosso create, comećamos a passar também o valor do campo: nome, para preenchermos o nosso input caso a requisićao enviada não passasse na validaćão do nosso controller store, logo, ele também estava caindo na regra que comentei acima: @seExistirAVariavelNome, adicione a linha: @method('PUT'), ou seja, comećou a passar essa linha no nosso formulário de edićão também, comećou a trocar o método de POST para PUT no ato de SALVAR um usuário, coisa que DEFINITIVAMENTE não queremos, logo, trocamos a regra para: SE váriavel update for igual a == true, adicione a linha: @method('PUT') e agora passaremos na view 'create' a váriavel 'update ' com o valor 'true' para voltar a adicionar a linha @method('PUT') quando esse template de formulário (que estou escrevendo este comentário aqui) for chamado (de bônus podemos ESPECIFICAR que o update quando chamarmos este formulário atual a partir da view: 'create' tenha o valor 'false', apenas opcional) --}}
    @if ($update)
        @method('PUT')
    @endif
    <div class="mb-3">
        <label for="nome" class="form-label">Nome:</label>
        <input type="text" id="nome" name="nome" class="form-control" {{-- SE EXISTIR/SE TIVER VALOR o campo "atributo 'nome' dentro do objeto série, ele exibe", se não, não exibe, pq? pq esse campo só terá valor no página de edição de série, no formulário de cadastro, não, assim podemos reutilizar o formulário de forma eficiente, resumidamente: old() me entrega os dados da request anterior, onde aqui estamos pegando o nome, mas poderiamos pegar QUALQUER outro campo que fosse necessário (para te uma ideia melhor dos campos que vêm, apenas dar um dd($request) lá no controller e ai escolher qual será o campo adequado) --}}
            @isset($nome) value="{{ $nome }}"@endisset />
    </div>
    <button type="submit" class="btn btn-dark">Adicionar</button>
</form>
