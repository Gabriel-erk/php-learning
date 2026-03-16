<?php 

// não coloco true pois desejo que a conversão seja para objeto mesmo
$converteParaObjeto = json_decode('{"nome":"Vinicius","anoNascimento":1997,"profissao":"Dev"}');

var_dump($converteParaObjeto);