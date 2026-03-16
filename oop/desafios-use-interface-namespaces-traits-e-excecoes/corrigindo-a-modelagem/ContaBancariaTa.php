<?php

// abstract pois não quero que seja instanciada diretamente (não quero que objetos sejam feitos a partir desta classe)
abstract class ContaBancariaTa
{
    // especifiquei como TA para padronizar como o nome dos arquivos desse exercicio estão e por conta que, quando chamei essa constante em uma das classes, associou com a constante de mesmo nome em outra classe de OUTRO exercicio (o que nao era o que eu queria), então deixei único o nome dessa constante de todos os arquivos presentes nesse repositório para não aver erro
    public const LIMITE_SAQUE_PADRAO_TA = 10000;
    private bool $ativa;
    public function __construct(public readonly ClienteTa $cliente, protected float $saldo, public readonly TipoContaTa $tipoConta)
    {
        // defindo que a conta bancária do cliente está ativa logo após ela ser criada (pois o __construct é executando INSTANTANEAMENTE após a criação do objeto em por exemplo: $contaUm = new ContaBancariaTa(parametros aqui) e os valores dentro dos parenteses são passados para o método construtor que já inicializa os atributos também pois colocamos os modificadores juntamente do nome do atributo e sua tipagem (public $cliente e protected $saldo))
        // o valor desse atributo é setado dentro do corpo do construtor pois ele não esta sendo defindo nos parenteses dele como: $cliente e $saldo pois esse aqui NÃO pode ter seu valor atribuido atraves do usuário (coisa que acontece quando temos parametros/inicialização de atributos nos parenteses do construtor), ele não pode simplesmente criar a conta dele com o status de ativação que quiser (pq não faz sentido algum também, imagina ele vai CRIAR sua conta e passa o valor booleano de false? conta já inicia como desativada? não tem logica e vai CONTRA nossa regra de negócio que é: nova conta bancária começa com o status ativo e só é desativada a partir de um método que valida se ele pode ou não desativar a conta no momento que o método responsavel for chamado para tal)
        $this->ativa = true;
    }

    // por mais que esteja publico, não tem como eu chamar este método em um arquivo de execução, sem uma instancia dessa classe (o que é impossivel pois é abstrata) ou a instancia de uma das classes filhas, logo, no momento posso deixar como public o modificador deste método
    public function getSaldo(): float
    {
        return $this->saldo;
    }

    public function estaAtiva(): bool
    {
        return $this->ativa;
    }

    public function depositar(float $valor): bool
    {
        if ($this->estaAtiva() && $valor > 0) {
            $this->saldo += $valor;
            return true;
        } else {
            return false;
        }
    }

    public function desativar(): bool
    {
        if ($this->saldo == 0 && $this->estaAtiva()) {
            $this->ativa = false;
            return true;
        } else {
            return false;
        }
    }

    public function ativar(): bool
    {
        if ($this->ativa == false) {
            $this->ativa = true;
            return true;
        } else {
            return false;
        }
    }

    // método abstrato (logo, será obrigatório nas classes filhas)
    abstract public function sacar(float $valor): bool;
}
