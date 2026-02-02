<?php

//BD
require '../../includes/config/database.php';

conectarDB();

// var_dump($db);

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';

// if($_SERVER['REQUEST_METHOD'] === 'POST'){
//     echo '<pre>';
//     var_dump($_POST);
//     echo '</pre>';

//     $titulo = $_POST['titulo'];
//     $precio = $_POST['precio'];
// }


// echo '<pre>';
// var_dump($_GET);
// echo '</pre>';

require '../../includes/funciones.php';

incluirTemplate('header');
//  include 'includes/templates/header.php';
 ?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form action="" class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad">

                <label for="imagen">Titulo:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea name="" id="descripcion" name="descripcion" ></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="habitaciones" min="1" max="10">

                <label for="wc">baños:</label>
                <input type="number" id="wc" name="wc" placeholder="baños"min="1" max="10">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="estacionamiento" min="1" max="10">
            </fieldset>

            <fieldset>
                <select name="" id="">
                    <option value="" disabled selected>**Seleccione**</option>
                    <option value="1">Edward</option>
                    <option value="2">Ana</option>
                </select>
                
            </fieldset>

            <input type="submit" value="Crear" class="boton boton-verde">
        </form>
    </main>

<?php

    incluirTemplate('footer');
 ?>
