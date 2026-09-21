<?php
// utilizando um namesapce
use Alura\Pdo\Domain\Model\Student;

// arquivo para chamar o arquivo de autoload para nosso projeto (require_once chama apenas uma vez)
require_once 'vendor/autoload.php';

// instanciando um objeto da classe estudadnte (que trouxemos para este arquivo graças ao nosso 'use' nas primeiras linhas de código que traz a classe 'Student' para cá)
$student = new Student(
    null,
    'Vinicius Dias',
    // instancia de um objeto da classe DateTimeImmutable, que estamos tendo acesso por estamos chamando do namespace 'raiz' do PHP graças a barra ao contrário antes da classe (\) 
    new \DateTimeImmutable('1997-10-15')
);

// exibindo sua idade
echo $student->age();
