<?php

class ClienteDesafioChat {
    public function __construct(public readonly string $nome, public readonly string $cpf) {
        
    }
    // getters não foram criados pois os atributos estão publicos, ou seja, podem ser acessados de qualquer arquivo e o readonly não permite alterações serem realizadas nele, apenas ter seu valor lido/exibido
}

