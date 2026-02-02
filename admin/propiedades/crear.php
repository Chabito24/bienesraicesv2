<?php

require '../../includes/funciones.php';

incluirTemplate('header');
//  include 'includes/templates/header.php';
 ?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form action="" class="formulario">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" placeholder="Titulo Propiedad">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" placeholder="Precio Propiedad">

                <label for="imagen">Titulo:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea name="" id="descripcion"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="habitaciones" min="1" max="10">

                <label for="wc">baños:</label>
                <input type="number" id="wc" placeholder="baños"min="1" max="10">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="number" id="estacionamiento" placeholder="estacionamiento" min="1" max="10">
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
