<?php

$resultado = $_GET['resultado'] ?? null;

require '../includes/funciones.php';

incluirTemplate('header');
//  include 'includes/templates/header.php';
 ?>
    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php 
            if(intval($resultado)  === 1):
        ?>
        <p class="alerta exito">Creado correctamente</p>

        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <th>1</th>
                    <th>casa en la playa</th>
                    <th><img src="/imagenes/8fe9b0324a38da8e4978c7e7dae5c313.jpg" class="imagen-tabla" alt=""></th>
                    <th>$270.000.000</th>
                    <th>
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                        <a href="#" class="boton-verde-block">Actualizar</a>
                    </th>
                </tr>
            </tbody>                
        </table>
    </main>

<?php

    incluirTemplate('footer');
 ?>
