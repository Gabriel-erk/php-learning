<?php 
namespace ScreenMatch\Calculos;

use ScreenMatch\Model\Titulo;

class CalculadoraDeMaratona 
{

    private int $duracaoMaratona = 0; 
    // cada vez que adicionar um titulo, tenho que calcular o tempo dele(lembrando que tenho minha classe titulo, e todo filme,serie etc é um titulo, logo, quando "adicionar um titulo" é adicionar um objeto do tipo titulo, ou seja, uma série ou filme (que herdam da classe titulo))
    // não importa se é serie ou filme, sei que todo "Titulo $titulo" tem o método "duracaoEmMinutos", logo, posso chamar esse método independente do tipo de objeto que estou passando (filme ou série)
    // observação citada no vídeo: estou passando na teoria "tipos diferentes" (serie e filme) onde o conceito trazido por trás de: objetos diferentes podem ter comportamentos iguais/realizar a mesma função ou que objetos iguais podem ser vistos de maneiras diferentes
    // no meu arquivo index.php, ao executar chamando este método, passando como parâmetro o objeto filme do tipo filme, lá ele será visto como do tipo filme, porém o mesmo objeto será visto dentro deste método como do tipo Título, logo, o mesmo objeto/váriavel, assume formas diferentes (numa parte sendo visto como da classe Titulo e na outra como da classe Filme)
    // Polimorfismo = o mesmo objeto pode ser visto de formas diferentes, pode ter um tipo em um determinado lugar e se comportar como outro tipo em determinado lugar (mesmo objeto podendo assumir diferentes formas, que é possível através da herança)
    public function inclui(Titulo $titulo): void{
        // qualquer objeto do tipo titulo poderá chamar o método abaixo e incrementar o valor retornado no atributo duracaoMaratona - e dependendo do "método que for passado" o calculo dentro de duracaoEmMinutos será diferente, pois cada classe filha (filme e série) implementam esse método de forma diferente
        $this->duracaoMaratona += $titulo->duracaoEmMinutos();
    }

    public function getDuracao(): int{
        return $this->duracaoMaratona;
    }
}
