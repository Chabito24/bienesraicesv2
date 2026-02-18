<?php

require 'includes/funciones.php';

incluirTemplate('header');
//  include 'includes/templates/header.php';
 ?>

    <main class="contenedor seccion">
        <h2>Casas y Aptos en venta</h2>

           <?php 
                $limite = 1000;
                include 'includes/templates/anuncios.php';
            ?>
    </main>

<?php

    incluirTemplate('footer');
 ?>
