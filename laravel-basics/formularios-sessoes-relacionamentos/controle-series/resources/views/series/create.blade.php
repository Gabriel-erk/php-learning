<x-layout title="Cadastro Série">
    {{-- SE houver ALGUM ou QUALQUER erro/dado, ele entra no if e exibe todos os erros pra mim --}}
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
    <form action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">

            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                {{-- autofocus serve para: toda vez que atualizar a página, ter o FOCO no campo automaticamente (como se tivesse com um hover ligado nele) --}}
                <input type="text" id="nome" autofocus name="nome" class="form-control" value="{{ old('nome') }}" />
            </div>

            <div class="col-2">
            <label for="seasonsQuantity" class="form-label">Nmr Temporadas :</label>
                <input type="text" id="seasonsQuantity" name="seasonsQuantity" class="form-control" value="{{ old('seasonsQuantity') }}" />
            </div>

            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Eps / Temporada:</label>
                <input type="text" id="episodesPerSeason" name="episodesPerSeason" class="form-control" value="{{ old('episodesPerSeason') }}" />
            </div>

        </div>
        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>
