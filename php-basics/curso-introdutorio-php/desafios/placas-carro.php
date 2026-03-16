<?php

$mapa_placas_carros = [
    'LMS-2312' => [
        'marca' => 'VW',
        'modelo' => 'Golf'
    ],
    'LMF-2242' => [
        'marca' => 'VW',
        'modelo' => 'Golf'
    ],
    'LFRFH-5642' => [
        'marca' => 'VW',
        'modelo' => 'Golf'
    ],
    'JHUY-0988' => [
        'marca' => 'VW',
        'modelo' => 'Golf'
    ],
];

foreach ($mapa_placas_carros as $placa => $carro) {
    echo "PLACA: $placa MARCA: $carro[marca] MODELO: $carro[modelo]"  . PHP_EOL;
}