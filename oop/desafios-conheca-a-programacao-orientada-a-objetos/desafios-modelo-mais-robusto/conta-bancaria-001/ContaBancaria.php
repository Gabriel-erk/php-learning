<?php

class ContaBancaria
{
    private bool $ativa;
    public function __construct(private string $titular, private float $saldo)
    {
        // os atributos passados por parâmetro já serão inicializados quando o objeto for inicializado, e quero que aqueles atributos sejam definidos pelo usuário, se a conta esta ativa ou não é algo que eu vou manipular e decidir com base nas minhas regras de negócio
        $this->ativa = true;
    }

    public function getTitular(): string
    {
        return $this->titular;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function depositar(float $valorDeposito): void
    {
        // os métodos não exergam nada fora deles sem o "$this", para mostrar que quero acessar outros atributos, métodos da nossa classe
        $verificaAtividadeConta = $this->verificaAtividade();
        if ($verificaAtividadeConta != true || $valorDeposito < 0) {
            echo "Não foi possível realizar o depósito do titular " . $this->titular . ", por favor, verifique se a conta esta ativa ou o valor do depósito foi maior que 0" . PHP_EOL;
        } else {
            $this->saldo += $valorDeposito;
            echo "Saldo depositado com sucesso!" . PHP_EOL;
            echo "Saldo atualizado: " . $this->saldo . PHP_EOL;
        }
    }

    public function sacar(float $valorSaque): void
    {
        $verificaAtividadeConta = $this->verificaAtividade();
        if ($verificaAtividadeConta != true || $valorSaque > $this->saldo) {
            echo "Não foi possível realizar o saque do titular " . $this->titular . ", por favor, verifique se a conta está ativa ou se o valor do saque é válido." . PHP_EOL;
        } else {
            $this->saldo -= $valorSaque;
            echo "Saque realizado com sucesso!" . PHP_EOL;
            echo "Novo saldo atualizado: " . $this->saldo . PHP_EOL;
        }
    }

    public function encerrarConta(): void
    {
        // ponto de melhoria do chat gpt (verificar se a conta está ativa antes de "desativa-la", pois, se ela já esta desativada, por que vou desativar de novo?)
        if ($this->ativa) {
            $this->ativa = false;
            echo "Conta do titular " . $this->titular . " foi desativada com sucesso." . PHP_EOL;
        } else {
            echo "A conta já se encontra desativada." . PHP_EOL;
        }
    }

    private function verificaAtividade(): bool
    {
        // $ativa é um atributo booleano, logo, é impossivel ele possui um valor diferente de true ou false, logo eu apenas dei um retorno nele, pois sempre vai ter um valor booleano, logo agindo de acordo com o retorno que o método me pede (um valor booleano)
        return $this->ativa;
    }
}
