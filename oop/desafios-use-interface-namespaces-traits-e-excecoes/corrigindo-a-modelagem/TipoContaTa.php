<?php 
// todos os enums seguem a mesma regra, então, caso não seja definido que os enums devem ter um valor (sendo considerados como backed enum), por padrão serão considerados como "todos os enum não possuem valor", ous seja, todos os case dos enum não poderão ter algo como "case Corrente = "Corrente", teria de ser o simples como: case Corrente; - porem quando especificamos que ela deve conter valor e o seu tipo, como: "enum TipoContaTa: string" será possível definir um valor para cada enum que eu tiver, logo: "case Corrente = "Corrente";" é possível - porem é possivel acessar o nome da chave, logo, no meu caso pelo menos, eu não precisaria definir valores, apenas acessar o atributo "name" dentro do meu enum, e no caso abaixo acessar "value", mas fica aqui de aprendizado
enum TipoContaTa: string {
    case Corrente = "corrente";
    case Poupanca = "poupança";
}