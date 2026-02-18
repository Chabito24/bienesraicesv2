<?php

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header('Location: /');
    }

    //Imortar la base de datos
    require 'includes/config/database.php';
    $db = conectarDB();

    //Consultar
    $query = "SELECT * FROM propiedades WHERE id = {$id}";


    // Ontener resultado
    $resultado = mysqli_query($db, $query);

    // echo"<pre>";
    // var_dump($resultado->num_rows);
    // echo"<pre>";

    if(!$resultado->num_rows) {
        header('Location: /');
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    require 'includes/funciones.php';
    incluirTemplate('header');
    //  include 'includes/templates/header.php';
 ?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>
        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="casa 1">
       

        <div class="anuncio resumen-propiedad">
            <p class="precio">$ <?php echo number_format((float)$propiedad['precio'], 0, ',', '.'); ?></p>

            <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" oading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad['wc']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono parqueadero">
                            <p><?php echo $propiedad['estacionamiento']; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $propiedad['habitaciones']; ?></p>
                        </li>
                    </ul>

                    <p>
                        <?php echo $propiedad['descripcion']; ?>
                    </p>
                    
                   

                    
        </div>    

    </main>

<?php
    mysqli_close($db);
    incluirTemplate('footer');
 ?>


