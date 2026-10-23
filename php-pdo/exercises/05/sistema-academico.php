<?php

use Pratica05Pdo\Infrastructure\Persistence\ConnectionCreator;
use Pratica05Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';
require_once 'src/Infrastructure/Persistence/StudentCreator.php';
require_once 'src/Domain/Model/Student.php';
require_once 'src/Domain/Repository/StudentRepository.php';
require_once 'src/Infrastructure/Repository/PdoStudentRepository.php';

function separator(): void
{
    echo PHP_EOL;
}

function double_separator(): void
{
    echo PHP_EOL . PHP_EOL;
}

$pdoConnection = ConnectionCreator::CreateConnection();
$pdoStudentRepository = new PdoStudentRepository($pdoConnection);
$students = $pdoStudentRepository->allStudents();

echo '=== CADASTRO REALIZADO ===';
double_separator();
foreach ($students as $student) {
    echo "ID: {$student->id()} | Name: {$student->name()}" . PHP_EOL;
}

separator();

echo '=== PESQUISA POR NASCIMENTO ===';
double_separator();
$searchedDate = new DateTimeImmutable('2005-09-09');
$studentsBrithAt = $pdoStudentRepository->studentsBirthAt($searchedDate);
echo "Foram encontrados " . count($studentsBrithAt) . " alunos com a data: {$searchedDate->format('Y-m-d')}";
double_separator();
foreach ($studentsBrithAt as $studentBirthAt) {
    echo "{$studentBirthAt->name()} - ID: {$studentBirthAt->id()} - Age: {$studentBirthAt->age()}" . PHP_EOL;
}

separator();

echo '=== ATUALIZAÇÃO DE ALUNO ===';
double_separator();
// se pensar um pouco vai entender este caso aqui também, se eu já atualizei na primeira vez que rodei, como rodando a segunda vez, funcionaria de novo? (se eu alterei isso no banco de dados?)
$students = $pdoStudentRepository->allStudents();
$studentToChange = $pdoStudentRepository->findById(1);
$studentOldName = $studentToChange->name();
$studentToChange->changeName('G.A');
$pdoStudentRepository->save($studentToChange);
echo "Nome anterior: {$studentOldName}" . PHP_EOL;
echo "Nome atualizado: {$studentToChange->name()}" . PHP_EOL;
echo "Resultado: " . ($studentToChange->name() != $studentOldName ? 'Atualização realizada com sucesso.' : 'Não foi possível atualizar.') . PHP_EOL;
separator();

echo '=== REMOÇÃO DE ALUNO ===';
double_separator();
// se voce parar para pensar um pouco vai entender pq essa operação vai funcionar apenas na primeira vez que for executada (após remover do banco de dados uma vez, como removerei de novo?)
$studentToRemove = $pdoStudentRepository->findById(4);
if ($studentToRemove != null) {
    echo "Aluno selecionado: {$studentToRemove->name()}" . PHP_EOL;
    echo "ID: {$studentToRemove->id()}" . PHP_EOL;

    echo ($pdoStudentRepository->delete($studentToRemove) ? 'Aluno removido com sucesso.' : 'Não foi possível remover o aluno.') . PHP_EOL;
} else {
    echo 'Aluno não encontrado.' . PHP_EOL;
}
separator();

echo '========== RELATÓRIO ACADÊMICO ==========';
double_separator();
$students = $pdoStudentRepository->allStudents();
$studentsCounter = count($students);
$ofLegalAgeStudentsCount = 0;
$minorStudentsCount = 0;
$studentsWithAgeMoreThanTwentyFive = 0;
$studentsAverage = 0;
foreach ($students as $student) {
    echo "ID: {$student->id()} | {$student->name()} | {$student->age()} | " . ($student->age() >= 18 ? "Maior de idade" : "Menor de idade") . PHP_EOL;
    // finalizar atribuição disso com if ternário
    $ofLegalAgeStudentsCount;
    $minorStudentsCount;
    $studentsWithAgeMoreThanTwentyFive;
}
separator();

echo '=============== ESTATÍSTICAS ===============';
double_separator();
echo "Total de alunos: $studentsCounter" . PHP_EOL;
echo "Maiores de idade: $studentsCounter" . PHP_EOL;
echo "Menores de idade: $studentsCounter" . PHP_EOL;
echo "Idade média: $studentsCounter" . PHP_EOL;
echo "Alunos com 25 anos ou mais: $studentsCounter" . PHP_EOL;

