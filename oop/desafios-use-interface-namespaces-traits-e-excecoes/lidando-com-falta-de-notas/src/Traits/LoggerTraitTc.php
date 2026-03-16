<?php 
/**
 * idea: array associativo onde cada chave representa o tipo da conta
 */
namespace FaltaNotas\Traits;
// método log está em uma trait pois será usada por várias classes diferentes
// serão chamado no método que coordena a ação, por exemplo, em sacar do service, ele chama o sacar da conta em questão, estava em dúvida em posicionar o log em service, porém ele deve ser chamado no método que coordena a ação, no caso do método transferir, é o service que coordena, faz a verificação e etc, não a conta, logo, o log ficaria nele
trait LoggerTraitTc
{
    private array $listaLogs = [];
    private int $contadorLogs = 0;
    // método log tem como função registrar o que está acontecendo no sistema, geralmente para ajudar em controle e debug
    // no método abaixo pedimos um parâmetro (mensagem da ação que acabamos de tomar, ex: criação de usuário no método "create" da entidade usuário, a mensagem passada para o método log será: $this->log("Usuário criado")), a fim de salvar o registro
    // mais afundo, estamos concatenando colchetes com a data atual (retornada por date('H:i:s') e com a mensagem passada por parâmetro)
    public function log(string $mensagem):void {
        $this->listaLogs[$this->contadorLogs] = "[" . date('H:i:s') . "] $mensagem\n";
        echo $this->listaLogs[$this->contadorLogs];
        $this->contadorLogs++;
    }

    public function getListaLogs(): array{
        return $this->listaLogs;
    }

}
