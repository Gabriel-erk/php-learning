<!-- o arquivo atual possui uma extensão .php, que nos permite escrever código php -->
<!-- neste arquivo também se mostra presente, conteúdos do tipo .html (tags html e etc)-->
<!-- ao abrirmos e fecharmos as tags php podemos utilizar comandos php como: echo 'Hello World' que este conteúdo será exibido quando abrirmos este arquivo na web, pelo fato do mesmo possui a extensão .php, para que seja possível ver o seu conteúdo (principalmente o html nele), é necessário subir este arquivo num servidor (php -S ondeQuerSubir:portaQueQuerSubir), caso seja colocado um echo 'Hello World' entre a abertura e fechamento das tags php abaixo, este conteúdo será EXIBIDO no navegador quando o servidor subir, pois o navegador, dentro de um arquivo com a extensão .php conseguirá INTERPRETAR o conteúdo do echo e exibir para nós o conteúdo do mesmo-->
<!--observação importante é que a linguagem php é uma linguagem de server-side (o que significa que é uma linguagem que é executada AO LADO (side) do servidor (server)), o que quer dizer que para geramos conteúdos dinâmicos (que se alteram em tempo real/durante a execução) é necessário que seja rodado um servidor dedicado (php -S ondeQueremosAbrir:portaQueQueremosAbrir, sem isso, não é possível gerar conteúdo que se altere em tempo real/de uso, um arquivo com a extensão .html, por exemplo, não precisa de um servidor dedicado para gerar uma página dinâmica (afinal, ele não é uma linguagem server-side/ao lado do servidor) -->
<?php

$produtosCafe = [
        [
                'nome' => 'Café Cremoso',
                'descricao' => 'Café cremoso irresistivelmente suave e que envolve seu paladar',
                'preco' => '5.00',
                'imagem' => 'img/cafe-cremoso.jpg',
        ],
        [
                'nome' => 'Café com Leite',
                'descricao' => 'A harmonia do café e do leite, uma experiência reconfortante',
                'preco' => '2.00',
                'imagem' => 'img/cafe-com-leite.jpg',
        ],
        [
                'nome' => "Cappuccino",
                'descricao' => "Café suave, leite cremoso e uma pitada de sabor adocicado",
                'preco' => "7.00",
                'imagem' => "img/cappuccino.jpg"
        ],
        [
                'nome' => "Café Gelado",
                'descricao' => "Café gelado refrescante, adoçado e com notas sutis de baunilha ou caramelo.",
                'preco' => "3.00",
                'imagem' => "img/cafe-gelado.jpg"
        ]
];

?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <title>Serenatto - Cardápio</title>
</head>
<body>
<main>
    <section class="container-banner">
        <div class="container-texto-banner">
            <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
        </div>
    </section>
    <h2>Cardápio Digital</h2>
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Opções para o Café</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-cafe-manha-produtos">
            <div class="container-produto">
                <div class="container-foto">
                    <img src="img/cafe-cremoso.jpg" alt="Café cremoso com leite e cobertura de chocolate.">
                </div>
                <p>Café Cremoso</p>
                <p>Café cremoso irresistivelmente suave e que envolve o seu paladar</p>
                <p>R$ 5.00</p>
            </div>
        </div>
    </section>
    <section class="container-almoco">
        <div class="container-almoco-titulo">
            <h3>Opções para o Almoço</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-almoco-produtos">
            <div class="container-produto">
                <div class="container-foto">
                    <img src="img/bife.jpg">
                </div>
                <p>Bife</p>
                <p>Bife, arroz com feijão e uma deliciosa batata frita</p>
                <p>R$ 27.90</p>
            </div>
            <div class="container-produto">
                <div class="container-foto">
                    <img src="img/prato-peixe.jpg">
                </div>
                <p>Filé de peixe</p>
                <p>Filé de peixe salmão assado, arroz, feijão verde e tomate.</p>
                <p>R$ 24.99</p>
            </div>
            <div class="container-produto">
                <div class="container-foto">
                    <img src="img/prato-frango.jpg">
                </div>
                <p>Frango</p>
                <p>Saboroso frango à milanesa com batatas fritas, salada de repolho e molho picante</p>
                <p>R$ 23.00</p>
            </div>
            <div class="container-produto">
                <div class="container-foto">
                    <img src="img/fettuccine.jpg">
                </div>
                <p>Fettuccine</p>
                <p>Prato italiano autêntico da massa do fettuccine com peito de frango grelhado</p>
                <p>R$ 22.50</p>
            </div>
        </div>

    </section>
</main>
</body>
</html>