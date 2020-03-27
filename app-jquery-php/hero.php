<?php


$heros = [

    [
        'prenom' => "walid",
        'nom' => "bilem"
    ],
    [
        'prenom' => "walid",
        'nom' => "bilem"
    ],
];


header(('content-type: application/json'));
echo json_encode($heros);