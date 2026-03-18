<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Series</title>
</head>
<body>
    <h1>Séris</h1>

    <ul>
        @foreach ($series as $serie)
            {{-- para colocar a váriavel recebida pelo controller, colocamos dentro de chaves duplas == {{ $variavel_objeto_chamadaDeMetodo/funcao_aqui_etc }} --}}
            <li>{{ $serie }}</li>
        @endforeach
    </ul>
    
</body>
</html>