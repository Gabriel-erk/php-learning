<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- o title que irá aparecer no navegador (dentro da tag title abaixo) e o title da página (h1 dentro do body) serão os mesmos, logo, atribuo a eles o mesmo valor --}}
    <title>{{ $title }} - Controle de Séries</title>
</head>

<body>
    <h1>{{ $title }}</h1>
    {{-- a estrutura em volta daqui será a mesma para todas as views, logo, estarei as repetindo, a única diferença que cada view terá da outra é o seu "corpo/conteudo", logo: a única coisa que cada view irá implementar ficará dentro de {{ $slot }} "herdando" o restante da página: não precisando criar outro body, outro head, tag de abrir/fechar html etc  --}}
    {{ $slot }}

</body>

</html>
