{{-- atributo personalizado do html, onde caso nosso layout esteja criado corretamente com a estrutura components/layout  apenas uso na tag x-layout que irá chama-lá corretamente // como criamos a váriavel $title, ela será passada como parâmetro juntamenta na definição da tag // tudo que colcoarmos dentro do nosso x-layout será jogado para a váriavel: $slot definida dentro do body de components/layout // x-layout == componente // x-nomeDoComponenteAquiDentroDaPastaComponents --}}
<x-layout title="Temporadas de {!! $series->nome !!}">
    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex align-items-center justify-content-between">
                Temporada {{ $season->number }}

                <span class="badge bg-secondary">
                    {{-- acessando o método de relacionamento dessa forma abaixo ($season->episodes) temos uma collection/array, que também tem acesso a um método count() que conta quantos registros aquela collection possui (conta quantos episodios eu tenho vinculados com a minha $season atual (que chamou a collection com $season->episodes)) obs: acessando $season->episodes() é o método de relacionamento, não um array --}}
                    {{ $season->episodes->count() }}
                </span>
            </li>
        @endforeach
    </ul>
</x-layout>
