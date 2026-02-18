<?php

    // Importar la conexión

    require '../includes/config/database.php';

    $db = conectarDB();


    // Escribir el Query
    $query = "SELECT * FROM propiedades";


    //Consultar la BD
    $resultadoConsulta = mysqli_query($db, $query);

    //muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    require '../includes/funciones.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id) {

            //Eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id = {$id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            $rutaImagen = '../imagenes/' . $propiedad['imagen'];

            if (!empty($propiedad['imagen']) && file_exists($rutaImagen)) {
                unlink($rutaImagen);
            }

            //Elimina la propiedad
            $query = "DELETE FROM propiedades WHERE id = {$id}";
            $resultado = mysqli_query($db, $query);

            if($resultado) {
                header('Location: /admin?resultado=3');
            }
        }

    }

    incluirTemplate('header');
    //  include 'includes/templates/header.php';
?>
        <main class="contenedor seccion">

        

            <div class="acciones-admin">

                <h1>Administrador de Bienes Raices</h1>
                                
                <a href="#"
                    class="btn-icon"
                    onclick="return confirm('¿Eliminar estas propiedades?');"
                    aria-label="Eliminar seleccionadas">
                    <img class="icono-eliminar" src="/build/img/icono-eliminar.svg" alt="" loading="lazy">
                </a>
            </div>
            <?php 
                if(intval($resultado)  === 1):
            ?>
                <p class="alerta exito">Creado correctamente</p>

            <?php 
                elseif (intval($resultado) === 2):      
            ?>
                <p class="alerta exito">Actualizado correctamente</p>

            <?php 
                elseif (intval($resultado) === 3): 
            ?>
                <p class="alerta exito">Eliminado correctamente</p>

            <?php endif; ?>

            <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
    

            <table class="propiedades">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select" name="select" value="1"> </th>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while( $propiedad = mysqli_fetch_assoc($resultadoConsulta) ): ?>
                    <tr>
                        <td><input type="checkbox" id="select" name="select" value="1"></td>
                        <td> <?php echo $propiedad['id']; ?> </td>
                        <td> <?php echo $propiedad['titulo']; ?> </td>
                        <td> 
                            <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla" alt="">    
                        </td>
                        <td>$ <?php echo number_format((float)$propiedad['precio'], 0, ',', '.'); ?> </td>
                        <td>
                            <form action="" method="POST" class="w-100">
                                <input 
                                    type="hidden" 
                                    name="id" 
                                    value="<?php echo $propiedad['id']; ?>">
                                <input 
                                    type="submit" class="boton-rojo-block" value="Eliminar"
                                    onclick="return confirm('¿Eliminar esta propiedad?');">
                            </form>
                            <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-verde-block">Actualizar</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>                
            </table>
        </main>

    <?php

        // cerrar la conexión
        mysqli_close($db);

        incluirTemplate('footer');
    ?>
