<?php 
namespace MaisOrganizacao\Model;

enum TipoContaTb {
    case Corrente;
    case Poupanca;
    case Salario;
}