<?php
namespace MaisOrganizacao\Model\Trait;
// não sabe nada sobre a conta (logo, elas não serão passadas como tipo nem como retorno, apenas receberá os valores de cada conta, assim, independente da conta, podendo ser tratadas todas da mesma forma, podendo fazer a reutilização em diversas contas (classes) diferentes que precisem dos métodos aqui presentes)
trait ValidacaoFinanceiraTb
{
    public function validarValorPositivo(float $valor): bool
    {
        if ($valor >= 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validarContaAtiva(bool $ativa): bool
    {
        if ($ativa) {
            return true;
        } else {
            return false;
        }
    }
}
