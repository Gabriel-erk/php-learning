<?php

require_once 'src/Domain/Model/Student.php';
require_once  'src/Domain/Repository/StudentRepository.php';
require_once 'src/Infrastructure/Repository/PdoStudentRepository.php';
require_once 'src/Infrastructure/Persistence/ConnectionCreator.php';

use Pratica04Pdo\Src\Domain\Model\Student;
use Pratica04Pdo\Src\Infrastructure\Persistence\ConnectionCreator;
use Pratica04Pdo\Src\Infrastructure\Repository\PdoStudentRepository;

$pdoConnection = ConnectionCreator::CreateConnection();
// instanciando um objeto da classe PdoStudentRepository
$pdoStudentRepository = new PdoStudentRepository($pdoConnection);

echo "=== CADASTRANDO ALUNOS ===" . PHP_EOL;

for ($i = 1; $i < 10; $i++) {
    $student = new Student(
        null,
        "Student " . $i + 1,
        new \DateTimeImmutable('1999-10-15')
    );
    if ($pdoStudentRepository->save($student)) {
        echo "Cadastro bem sucedido do estudante com id: {$pdoConnection->lastInsertId()}" . PHP_EOL;
    }
}

echo PHP_EOL . "=== LISTAGEM DE ALUNOS ===" . PHP_EOL;

$students = $pdoStudentRepository->allStudents();
$pdoStudentRepository->studentList($students);

echo PHP_EOL . "=== LISTAGEM DE ALUNOS POR DATA DE NASCIMENTO ===" . PHP_EOL;
$studentsBirthAt = $pdoStudentRepository->studentsBirthAt(new \DateTimeImmutable('1999-10-15'));
$pdoStudentRepository->studentList($studentsBirthAt);

echo PHP_EOL . "=== ATUALIZAÇÃO DE ALUNO ===" . PHP_EOL;
$studentToChange = $pdoStudentRepository->findById(1);
$studentToChange->changeName('Robert');
$pdoStudentRepository->save($studentToChange);
$pdoStudentRepository->studentList($students);

echo PHP_EOL . "=== REMOVENDO UM ALUNO ===" . PHP_EOL;
$studentToRemove = $pdoStudentRepository->findById(2);
if ($studentToRemove != null && $pdoStudentRepository->remove($studentToRemove)) {
    echo "Aluno removido com sucesso." . PHP_EOL;
} else {
    echo "Não foi possível remover o aluno." . PHP_EOL;
}
$students = $pdoStudentRepository->allStudents();
$pdoStudentRepository->studentList($students);

echo PHP_EOL . "=== RELATÓRIO DE ALUNOS ===" . PHP_EOL;
$studentList = $pdoStudentRepository->allStudents();
$studentCount = 0;
$ofLegalAgeStudenCount = 0;
$minorStudentCount = 0;
foreach ($studentList as $student) {
    $pdoStudentRepository->showStudent($student);
    if ($student->age() >= 18) {
        $ofLegalAgeStudenCount++;
    } else {
        $minorStudentCount++;
    }
    $studentCount++;
}

echo PHP_EOL . "=== RESUMO ===" . PHP_EOL;

echo "Total de alunos: $studentCount" . PHP_EOL;
echo "Maiores de idade: $ofLegalAgeStudenCount" . PHP_EOL;
echo "Menores de idade: $minorStudentCount" . PHP_EOL;