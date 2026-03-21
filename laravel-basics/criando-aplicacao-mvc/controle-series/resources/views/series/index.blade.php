{{-- atributo personalizado do html, onde caso nosso layout esteja criado corretamente com a estrutura components/layout  apenas uso na tag x-layout que irá chama-lá corretamente // como criamos a váriavel $title, ela será passada como parâmetro juntamenta na definição da tag // tudo que colcoarmos dentro do nosso x-layout será jogado para a váriavel: $slot definida dentro do body de components/layout // x-layout == componente // x-nomeDoComponenteAquiDentroDaPastaComponents --}}
<x-layout title="Séries">
    <a href="/series/criar" class="btn btn-dark mb-2">Adicionar</a>

    <ul class="list-group">
        @foreach ($series as $serie)
            {{-- para colocar a váriavel recebida pelo controller, colocamos dentro de chaves duplas == {{ $variavel_objeto_chamadaDeMetodo/funcao_aqui_etc }} --}}
            <li class="list-group-item">{{ $serie }}</li>
        @endforeach
    </ul>
</x-layout>
