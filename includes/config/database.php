<?php

function conectarDB() : mysqli {
    $env = parse_ini_file(__DIR__ . '/../../.env');


    $db = mysqli_connect(
        $env['DB_HOST'],
        $env['DB_USER'],
        $env['DB_PASS'],
        $env['DB_NAME'],
        (int)$env['DB_PORT']
    );

    if(!$db) {
        die("Error en la conexión: ". mysqli_connect_error());
    }
    return $db;
}