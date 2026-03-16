<?php

// criar função com parâmetros e retorno do tipo float que realize o calclo da média e a retorne

function media_bimestral_escola (float $nota1, float $nota2) : float 
{
    $media = ($nota1 + $nota2) / 2;

    return $media;
}

echo media_bimestral_escola(5.0, 9.2);