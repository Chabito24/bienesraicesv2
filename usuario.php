<?php

    // Importar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();


    // Crear un email y pasword
    $email = "emartinezj1802@gmail.com";
    $password = "123456";


    //Query oara crear el usuario
    $query = " INSERT INTO usuarios (email, password) VALUES ('{$email}', '{$password}');";

    echo $query;

    
    //Agregarlo a la base de datos

    mysqli_query($db, $query);