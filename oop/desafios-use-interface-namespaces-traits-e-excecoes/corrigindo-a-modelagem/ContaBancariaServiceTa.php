<?php
// essa classe NÃO ALTERA O SALDO DIRETAMENTE
// apenas chama métodos das contas bancarias, interpreta o retorno que elas irão dar (todas foram configuradas para retornar um valor booleano, ou seja, true ou false)
// e a classe devolve MENSAGENS (ou seja, os métodos devolvem mensagens a respeito do resultado das execuções dos métodos das classes)
class ContaBancariaServiceTa
{
    // outra parte do polimorfismo, pois minha classe ContaBancariaService/método sacar/depoito não sabe se o valor que está sendo passado para o parâmetro "ContaBancariaTa $conta" é corrente ou poupança e mesmo assim o comportamento será o mesmo (objetos "diferentes" com comportamentos iguais, no caso, dando certo o retorno das mensagens será o mesmo)
    public function depositar(ContaBancariaTa $conta, float $valor): string
    {
        if ($conta->depositar($valor)) {
            return "Depósito na conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . " realizada com sucesso!";
        } else {
            return "Depósito na conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . " não foi realizada, verificar se conta está ativa ou valor para depósito é maior do que zero.";
        }
    }

    public function sacar(ContaBancariaTa $conta, float $valor): string
    {
        if ($conta->sacar($valor)) {
            return "Saque na conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . " realizada com sucesso!";
        } else {
            return "Saque na conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . " não foi realizada, verificar se conta está ativa ou digitou um valor válido (respeitando limite de saque e taxa de manutenção (taxa de manutenção apenas em contas correntes))."; // esclareço apenas que a taxa de manuteção existe em contas correntes pois contas poupanças não tem, e por mais que eu não use a contante "LIMITE_SAQUE_PADRAO" em contas poupanças elas também tem um "limite" não explicito, que seria o "$valor <= $this->saldo" , onde o limite de valor para saques em conta poupança é que "o valor que voce quer sacar TEM que ser menor ou igual seu saldo em conta", logo, também possuimos um limite indireto em contas poupanças, por mais que não use a constante "LIMITE_SAQUE_PADRAO"  
        }
    }

    public function desativar(ContaBancariaTa $conta): string
    {
        if ($conta->desativar()) {
            return "Conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . ", desativada com sucesso!";
        } else {
            return "Conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . ", não foi desativada, por favor verificar se conta já não se encontra desativada ou saldo ainda é diferente de 0.";
        }
    }

    public function ativar(ContaBancariaTa $conta): string
    {
        if ($conta->ativar()) {
            return "Conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . " foi reativada com sucesso!";
        } else {
            return "Conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . " já se encontra ativa.";
        }
    }

    public function status(ContabancariaTa $conta): string
    {
        if ($conta->estaAtiva()) {
            return "Conta " . $conta->tipoConta->value . " está ativa.";
        } else {
            return "Conta " . $conta->tipoConta->value . " está desativada.";
        }
    }

    public function saldo(ContaBancariaTa $conta): string
    {
        // seguindo com base na nossa regra de negócio, uma conta só pode ser desativada caso esteja com o saldo zerado, logo, qual o sentido de tentar acessar o valor que possui? ele obviamente sempre vai ser zero, então para deixar esse sistema mais vivo, colocarei essa verificação, se a conta estiver ativa, ela PODE ter um saldo diferente de zero, logo aplico uma mensagem personalizada, do contrário, lembro o usuário que sua conta está desativada e obviamente não possui saldo disponível/diferente de zero
        if ($conta->estaAtiva()) {
            return "O saldo da conta " . $conta->tipoConta->value . " do cliente: " . $conta->cliente->nome . " é de R$ " . number_format($conta->getSaldo(), 2, ',', '.');
        } else {
            return "Contas desativadas não possuem saldo.";
        }
    }
}
