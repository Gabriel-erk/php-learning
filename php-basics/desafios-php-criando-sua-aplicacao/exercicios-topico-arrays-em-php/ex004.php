<?php

$familiares = [
    "familiaParteDeMae" => [
        "tia" => [
            "nome" => "leticia",
            "idade" => 32,
        ],
        "tio" => [
            "nome" => "christiano",
            "idade" => 42,
        ],
        "primo" => [
            "nome" => "kaleb",
            "idade" => 1,
        ],
    ],
    "familiaParteDePai" => [
        "tia" => [
            "nome" => "silvia",
            "idade" => 52,
        ],
        "tio" => [
            "nome" => "carlos",
            "idade" => 55,
        ],
        "primo" => [
            "nome" => "roberto",
            "idade" => 22,
        ],
    ],
];

$jose = [
    "nome" => "jose",
    "idade" => 30,
];

$familiares["familiaParteDePai"]["tioDistante"] = $jose;

var_dump($familiares);
