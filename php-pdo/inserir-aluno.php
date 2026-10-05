<?php 

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';
// conseguindo nossa conexão com PDO
$pdo = ConnectionCreator::createConnection();

$student = new Student(null, 'Vinicius Dias', new \DateTimeImmutable('2006-11-28'));

// o ? em values indica que estarei passando valores do tipo texto para estes campos marcados em ?, onde o primeiro ? faz referência a coluna 'name' e o segundo ? a coluna 'birth_date' 
$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (?,?)";
// para termos essa abordagem de passar os valores para a nossa string sql sem ser diretamente por ela, estaremos usando o método prepare do nosso objeto $pdo passando o nosso sql como parâmetro para o mesmo, como boas práticas nomeamos a váriavel que receberá o resultado dessa operação com o objeto $pdo como 'statement' pois o tipo do objeto retornado da operação $pdo->prepare($sqlinsert) é do tipo PDOStatement
// usamos o prepare como forma de conversamos com o banco de dados previamente para ele se 'preparar' para receber nossa linha sql
// obs:toda essa abordagem sendo descrita tem a finalidade de evitar sql injection através das instrucões sql, a forma como faziamos antes permitia que isso acontecesse sem rodeios, porém preparando e passando os parâmetros corretamente como faremos agora isso não irá acontecer pois o php irá ler exatamente o que iremos mandar e adicionar os caracteres de escape corretos para que não sejam enviados comandos como: DROP TABLE nossaTabelaAqui através de instruções sql, caso alguem o faça, a coluna para a qual essa instrução maliciosa foi enviada apenas terá esse valor(por ex: campo nome foi recebido o valor: DROP TABLE students, da forma antiga a nossa tabela seria dropada, mas agora, o campo nome terá esse valor: DROP TABLE students) e manterá a integridade do nosso sistema
// recebendo um retorno da operação abaixo ($pdo->prepare($sqlInsert)), dentro do nosso objeto do tipo PDOStatement, teremos a nossa linha SQL preparada
$statement = $pdo->prepare($sqlInsert);
// como nosso statement possui nossa linha sql preparada (por conta da linha acima), usaremos o método bindValue para passar o parâmetro aos ? da nossa instrução SQL
// nessa linha abaixo, com o número '1' estamos informando que o primeiro parâmetro (primeiro ? da instrução SQL), terá como valor o segundo parâmetro do nosso método bindValue == $student->name()
$statement->bindValue(1, $student->name());
$statement->bindValue(2, $student->birthDate()->format('Y-m-d'));

// por fim, para executarmos a instrução SQL presente dentro do nosso objeto do tipo PDOStatement usamos o método execute(), que estará nos retornando apenas true ou false, consequentemente, usamos esse if para fazer a exibição, caso retorne true, exiba o conteúdo das {} do if
if ($statement->execute()) {
    echo "Aluno incluído" . PHP_EOL;
}