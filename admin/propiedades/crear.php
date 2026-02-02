<?php

//BD
require '../../includes/config/database.php';

$db = conectarDB();

$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

// var_dump($db);

// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';

// echo '<pre>';
// var_dump($_GET);
// echo '</pre>';

$errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedores_Id = '';


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    $titulo = $_POST['titulo'] ?? '';
    $precio = $_POST['precio'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $habitaciones = $_POST['habitaciones'] ?? '';
    $wc = $_POST['wc'] ?? '';
    $estacionamiento = $_POST['estacionamiento'] ?? '';
    $vendedores_Id = $_POST['vendedor'] ?? '';

    if(!$titulo) {
        $errores[] = 'debes añadir un titulo';
    }

      if(!$precio) {
        $errores[] = 'debes añadir un precio';
    }

      if(strlen( $descripcion ) < 50 ) {
        $errores[] = 'debes añadir una descripcion mayor a 50 caracteres';
    }

      if(!$habitaciones) {
        $errores[] = 'debes añadir una habitaciones';
    }

      if(!$wc) {
        $errores[] = 'debes añadir un wc';
    }

      if(!$estacionamiento) {
        $errores[] = 'debes añadir un estacionamiento';
    }

      if(!$vendedores_Id) {
        $errores[] = 'debes añadir un Vendedor';
    }

    // echo '<pre>';
    // var_dump($errores);
    // echo '</pre>';

    if(empty($errores)) {


        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, vendedorId) VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento, '$vendedorId' )";

    // echo $query;

        $resultado = mysqli_query($db, $query);

        if($resultado) {
            echo 'insertado correctamente';
        }  
    }  


    
}




require '../../includes/funciones.php';

incluirTemplate('header');
//  include 'includes/templates/header.php';
 ?>
    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form action="" class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input 
                    type="text" 
                    id="titulo" 
                    name="titulo" 
                    placeholder="Titulo Propiedad" 
                    value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="precio" 
                    placeholder="Precio Propiedad" 
                    value="<?php echo $precio; ?>">

                <label for="imagen">Imagen: </label>
                <input 
                    type="file" 
                    id="imagen" 
                    accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea 
                    name="descripcion" 
                    id="descripcion" 
                    name="descripcion" 
                    value=""><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones" 
                    placeholder="habitaciones" 
                    min="1" 
                    max="10" 
                    value="<?php echo $habitaciones; ?>">

                <label for="wc">baños:</label>
                <input 
                    type="number" 
                    id="wc" 
                    name="wc" 
                    placeholder="baños" 
                    min="1" 
                    max="10" 
                    value="<?php echo $wc ; ?>">

                <label for="estacionamiento">Estacionamientos:</label>
                <input 
                    type="number" 
                    id="estacionamiento" 
                    name="estacionamiento" 
                    placeholder="estacionamiento" 
                    min="1" 
                    max="10" 
                    value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <select name="vendedor" id="vendedor">
                    <option value="" disabled <?php echo ($vendedores_Id === '') ? 'selected' : ''; ?>>
                        **Seleccione**
                    </option>

                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option 
                        value="<?php echo $vendedor['id']; ?>"
                        <?php echo ((string)$vendedores_Id === (string)$vendedor['id']) ? 'selected' : ''; ?>
                        >
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                
            </fieldset>

            <input type="submit" value="Crear" class="boton boton-verde">
        </form>
    </main>

<?php

    incluirTemplate('footer');
 ?>
