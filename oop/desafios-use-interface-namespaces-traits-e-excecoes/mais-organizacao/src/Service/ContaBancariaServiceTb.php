<?php
namespace MaisOrganizacao\Service;

use MaisOrganizacao\Model\ContaBancariaTb;
use MaisOrganizacao\Model\TipoContaTb;

class ContaBancariaServiceTb
{
    public function depositar(ContaBancariaTb $conta, float $valor): string
    {
        if ($conta->depositar($valor)) {
            return "Depósito na conta {$conta->tipoConta->name} do cliente {$conta->cliente->nome} realizado com sucesso!";
        } else {
            return "Depósito na conta {$conta->tipoConta->name} do cliente {$conta->cliente->nome} não foi efetuada, verificar se conta está ativa ou valor é maior que 0.";
        }
    }

    // aprendizado com este método: método que altera estado, como este (que altera o saldo da conta) não deve ser chamado mais de uma vez em uma verificação como eu estava fazendo onde eu verificava como condição de if e else if o resultado booleano da seguinte operação: $conta->sacar($valor)
    // não chamar método que altera estado de algo em um if (no nosso caso, o "estado" seria um método que modifica "ativa" e "saldo" que seria = modificar estado)
    // principal motivo de não fazer isso: se o método alterar o estado, na segunda vez que for chamado (no else if) o estado já estará alterado e o resultado pode ser diferente do esperado, pois, durante a execução do método sacar no primeiro if (dentro do foreach no index) ao verificar se a condição $conta->sacar($valor) retorna true ou false, ele irá EXECUTAR esse código, ou seja, o saque será efetuado mesmo se a próxima condição for falsa
    // logo, quando ele EXECUTAVA (sacava TUDO, pois era o que eu estava pedindo no index, para sacar tudo de uma vez na conta salário e contra poupança) e depois falhava na proxima condição, no caso, de ser conta corrente ou não, o resultado retornado era false, o que fazia com que caisse no elseif e o retorno fosse FALSE novamente pois, novamente, ao verificar a condição $conta->sacar($valor) essa linha era executada e retornava false, pois o saque não foi possivel (ele já foi feito na verificação do primeiro if, logo, eu já saquei tudo) e ai caia no else, retornando a mensagem que não foi possível realizar o saque (por mais que o saque tenha sim sido efetuado como explicado acima)
    public function sacar(ContaBancariaTb $conta, float $valor): string
    {
        $resultado = $conta->sacar($valor);
        // apliquei um if para mostrar uma mensagem mais específica para o usuário quando for conta corrente para ele ter noção que foi descontado 5% de taxa, porém voce disse sem if por tipo de conta, seria errado?

        if ($resultado && $conta->tipoConta == TipoContaTb::Corrente) {
            return "Saque na conta {$conta->tipoConta->name} do cliente {$conta->cliente->nome} realizado com sucesso! (com taxa de 5% aplicada)";
        }

        if ($resultado) {
            return "Saque na conta {$conta->tipoConta->name} do cliente {$conta->cliente->nome} realizado com sucesso!";
        }

        return "Saque na conta {$conta->tipoConta->name} do cliente {$conta->cliente->nome} não foi efetuado, verificar se conta está ativa ou valor é válido.";
    }

    public function verSaldo(ContaBancariaTb $conta): string
    {
        return "O saldo atual da conta {$conta->tipoConta->name} do cliente {$conta->cliente->nome} é de R$ {$conta->getSaldo()}.";
    }

    // método para facilitar meus testes no index.php
    public function saldo(ContaBancariaTb $conta): float
    {
        return $conta->getSaldo();
    }

    public function desativar(ContaBancariaTb $conta): string
    {
        if ($conta->desativar()) {
            return "Conta {$conta->tipoConta->name} do cliente {$conta->cliente->nome} foi desativada com sucesso!";
        } else {
            return "Conta {$conta->tipoConta->name} do cliente {$conta->cliente->nome} não foi desativada, verificar se saldo ainda é positivo ou já não foi desativada.";
        }
    }
}
