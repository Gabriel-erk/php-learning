<!-- o arquivo atual possui uma extensão .php, que nos permite escrever código php -->
<!-- neste arquivo também se mostra presente, conteúdos do tipo .html (tags html e etc)-->
<!-- ao abrirmos e fecharmos as tags php podemos utilizar comandos php como: echo 'Hello World' que este conteúdo será exibido quando abrirmos este arquivo na web, pelo fato do mesmo possui a extensão .php, para que seja possível ver o seu conteúdo (principalmente o html nele), é necessário subir este arquivo num servidor (php -S ondeQuerSubir:portaQueQuerSubir), caso seja colocado um echo 'Hello World' entre a abertura e fechamento das tags php abaixo, este conteúdo será EXIBIDO no navegador quando o servidor subir, pois o navegador, dentro de um arquivo com a extensão .php conseguirá INTERPRETAR o conteúdo do echo e exibir para nós o conteúdo do mesmo-->
<!--observação importante é que a linguagem php é uma linguagem de server-side (o que significa que é uma linguagem que é executada AO LADO (side) do servidor (server)), o que quer dizer que para geramos conteúdos dinâmicos (que se alteram em tempo real/durante a execução) é necessário que seja rodado um servidor dedicado (php -S ondeQueremosAbrir:portaQueQueremosAbrir, sem isso, não é possível gerar conteúdo que se altere em tempo real/de uso, um arquivo com a extensão .html, por exemplo, não precisa de um servidor dedicado para gerar uma página dinâmica (afinal, ele não é uma linguagem server-side/ao lado do servidor) -->
<?php

$produtosCafe = [
        [
                'nome' => 'Café Cremoso',
                'descricao' => 'Café cremoso irresistivelmente suave e que envolve seu paladar.',
                'preco' => '5.00',
                'imagem' => 'img/cafe-cremoso.jpg',
        ],
        [
                'nome' => 'Café com Leite',
                'descricao' => 'A harmonia do café e do leite, uma experiência reconfortante.',
                'preco' => '2.00',
                'imagem' => 'img/cafe-com-leite.jpg',
        ],
        [
                'nome' => "Cappuccino",
                'descricao' => "Café suave, leite cremoso e uma pitada de sabor adocicado.",
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
$produtosAlmoco = [
        [
                'nome' => 'Bife',
                'descricao' => 'Bife, arroz com feijão e uma deliciosa batata frita.',
                'preco' => '27.90',
                'imagem' => 'img/bife.jpg'
        ],
        [
                'nome' => 'Filé de peixe',
                'descricao' => 'Filé de peixe salmão assado, arroz, feijão verde e tomate.',
                'preco' => '24.99',
                'imagem' => 'img/prato-peixe.jpg'
        ],
        [
                'nome' => 'Frango',
                'descricao' => 'Saboroso frango à milanesa com batatas fritas, salada de repolho e molho picante.',
                'preco' => '23.00',
                'imagem' => 'img/prato-frango.jpg'
        ],
        [
                'nome' => 'Fettuccine',
                'descricao' => 'Prato italiano autêntico da massa do fettuccine com peito de frango grelhado.',
                'preco' => '22.50',
                'imagem' => 'img/fettuccine.jpg'
        ],
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
            <!-- definindo que quero começar (estou marcando o início dele na linha abaixo) um foreach neste html -->
            <?php foreach ($produtosCafe as $produtoCafe): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <!-- como nas linhas abaixo queremos apenas IMPRIMIR/EXIBIR uma info, colocariamos apenas a palavra reservada 'echo' seguido da informação que será exibida (<?php echo $produtoCafe['imagem'] ?>), porém seria uma estrutura 'repetitiva' fazer isso em todos os campos que o necessitasem, por isso, o php nos fornecesse uma 'abreviação para isso: <?= $produtoCafe[''] ?> fazendo uso do sinal de menor, interrogação e sinal de atribuição para quando queremos apenas EXIBIR alguma informação (usar o echo basicamente, como descrito acima) -->
                        <img src="<?= $produtoCafe['imagem'] ?>"
                             alt="<?= $produtoCafe['descricao'] ?>">
                    </div>
                    <p><?= $produtoCafe['nome'] ?></p>
                    <p><?= $produtoCafe['descricao'] ?></p>
                    <p><?= 'R$ ' . $produtoCafe['preco'] ?></p>
                </div>
                <!-- marcando o fim do foreach iniciado nas linhas acima, logo, tudo que estiver entre o começo e o fim do foreach será repetido até o fim do array escolhido ($produtosCafe)-->
            <?php endforeach; ?>
        </div>
    </section>
    <section class="container-almoco">
        <div class="container-almoco-titulo">
            <h3>Opções para o Almoço</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-almoco-produtos">
            <?php foreach ($produtosAlmoco as $produtoAlmoco): ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $produtoAlmoco['imagem'] ?>" alt="<?= $produtoAlmoco['descricao'] ?>">
                    </div>
                    <p><?= $produtoAlmoco['nome'] ?></p>
                    <p><?= $produtoAlmoco['descricao'] ?></p>
                    <p><?= 'R$' . $produtoAlmoco['preco'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </section>
</main>
</body>
</html>