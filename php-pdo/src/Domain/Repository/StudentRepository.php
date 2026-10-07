<?php
// o dono deste projeto é alguém de negócios, não necessariamente de tecnologia, somos pagos para atender as demandas de um inexperiente na área, logo, as coisas que estão na pasta 'domínio', dizem respeito a esse dono, e coisas infraestrutura, esses detalhes mais intrinsecos que são importantes APENAS para quem está envolvido no desenvolvimento, fica na parte de Infraestrutura, outra pasta da nossa pasta src = source

// repositório de alunos é considerado uma regra de negócio, logo, faz parte do domínio do sistema, porém, não entra como um 'modelo' (por isso veio parar aqui, na pasta Repository)

// esta em forma de interface, pois nada está sendo implementado de fato/nada precisa ser implementado diretamente neste arquivo

// isso é uma representação de repositório de estudante (repositório permite que eu guarde muitas informações, ou aqui, pode ser interpretado, como uma forma de acessar/manipular as informações de estudantes, pois podemos salvar, remover e trazer informações específicas de mais de um estudantes através de allStudents ou studentsBirthAt, essa é a nossa forma principal de manipular dados de uma classe seguindo as boas práticas)

namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents(): array;
    public function studentsBirhAt(\DateTimeImmutable $birthDate): array;
    public function save(Student $student): bool;
    public function remove(Student $student): bool;
}
