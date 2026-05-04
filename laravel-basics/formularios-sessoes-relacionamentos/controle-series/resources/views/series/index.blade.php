{{-- atributo personalizado do html, onde caso nosso layout esteja criado corretamente com a estrutura components/layout  apenas uso na tag x-layout que irá chama-lá corretamente // como criamos a váriavel $title, ela será passada como parâmetro juntamenta na definição da tag // tudo que colcoarmos dentro do nosso x-layout será jogado para a váriavel: $slot definida dentro do body de components/layout // x-layout == componente // x-nomeDoComponenteAquiDentroDaPastaComponents --}}
<x-layout title="Séries">
    {{-- para chamar uma rota por apelido, primeiro adicionamos as {{  }} para informar que usaremos uma função/código bruto php e chamamos a função route() passando de parâmetro o apelido que definimos para nossa rota em "web.php" --}}
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Adicionar</a>

    {{-- quero exibir o valor de $mensagemSucesso apenas se ela possuir algum valor, onde o isset nos ajuda nesse caso, onde verificamos, onde @isset($mensagemSucesso) resume um if para nós, no caso um if ($mensagemSucesso != null){exiba o conteúdo aqui}, é exatamente isso que ela faz, caso retorne false em @isset($mensagemSucesso) ele não execute o corpo do mesmo e não cria a div --}}
    @isset($mensagemSucesso)
        <div class="alert alert-success">
            {{ $mensagemSucesso }}
        </div>
    @endisset

    <ul class="list-group">
        @foreach ($series as $serie)
            {{-- para colocar a váriavel recebida pelo controller, colocamos dentro de chaves duplas == {{ $variavel_objeto_chamadaDeMetodo/funcao_aqui_etc }} --}}
            {{-- exibir apenas $serie seria a mesma coisa que dar um var_dump em um objeto, por isso, na nossa serie, queremos acessar o campo "nome" e para isso, temos de especificar aqui (pois nossa serie é um objeto e queremos mostrar apenas UMA de suas propriedades // laravel podia ter trazido uma rray associativo onde a sintax para exibir seria: $serie['nome'] porém trouxe um objeto, logo, a sintax de acesso a propriedade nome é: $serie->nome) --}}
            <li class="list-group-item d-flex align-items-center justify-content-between">
                {{ $serie->nome }}
                <a class="btn btn-danger btn-sm" href="{{ route('series.edit', $serie->id) }}" type="submit">editar</a>
                <form action="{{ route('series.destroy', $serie->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" type="submit">X</button>
                </form>
            </li>
        @endforeach
    </ul>
</x-layout>
